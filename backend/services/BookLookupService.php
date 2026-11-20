<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../utils/exceptions.php';
require_once __DIR__ . '/../utils/Validator.php';

final class BookLookupService
{
    private const UNAVAILABLE = 'The book information service is not available right now. Please try again later.';

    public function search(string $query): array
    {
        $query = Validator::text($query, 'query', 2, 120);
        $baseUrl = method_exists(Config::class, 'OPEN_LIBRARY_SEARCH_URL')
            ? Config::OPEN_LIBRARY_SEARCH_URL()
            : 'https://openlibrary.org/search.json';
        $timeout = method_exists(Config::class, 'EXTERNAL_API_TIMEOUT')
            ? Config::EXTERNAL_API_TIMEOUT()
            : 5;
        $url = $baseUrl . '?' . http_build_query([
            'q' => $query,
            'limit' => 8,
            'fields' => 'title,author_name,first_publish_year,key,cover_i',
        ]);

        $handle = curl_init($url);
        if ($handle === false) {
            $this->logFailure('could not initialize cURL');
            throw new ExternalServiceException(self::UNAVAILABLE);
        }
        curl_setopt_array($handle, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CONNECTTIMEOUT => 3,
            CURLOPT_TIMEOUT => $timeout,
            CURLOPT_HTTPHEADER => ['Accept: application/json'],
        ]);

        $body = curl_exec($handle);
        $curlError = curl_error($handle);
        $statusCode = (int) curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);

        if ($body === false || $statusCode !== 200) {
            $this->logFailure('request failed', $curlError, $statusCode);
            throw new ExternalServiceException(self::UNAVAILABLE);
        }

        $response = json_decode($body, true);
        if (!is_array($response) || !isset($response['docs']) || !is_array($response['docs'])) {
            $this->logFailure('response did not contain a valid result list');
            throw new ExternalServiceException(self::UNAVAILABLE);
        }

        $books = [];
        foreach ($response['docs'] as $book) {
            if (!is_array($book) || !isset($book['title']) || !is_string($book['title'])) {
                continue;
            }

            $books[] = [
                'title' => $book['title'],
                'authors' => isset($book['author_name']) && is_array($book['author_name'])
                    ? array_values(array_filter($book['author_name'], 'is_string'))
                    : [],
                'first_publish_year' => isset($book['first_publish_year']) ? (int) $book['first_publish_year'] : null,
                'work_key' => isset($book['key']) && is_string($book['key']) ? $book['key'] : null,
                'cover_id' => isset($book['cover_i']) ? (int) $book['cover_i'] : null,
            ];
        }

        return ['query' => $query, 'results' => $books];
    }

    private function logFailure(string $reason, string $curlError = '', int $statusCode = 0): void
    {
        $details = trim(implode(' ', array_filter([$reason, $curlError, $statusCode > 0 ? "HTTP $statusCode" : ''])));
        error_log('Open Library: ' . $details . PHP_EOL, 3, __DIR__ . '/../logs/error.log');
    }
}
