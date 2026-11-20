<?php
declare(strict_types=1);

require_once __DIR__ . '/exceptions.php';

final class RequestData
{
    public static function jsonBody(): array
    {
        $data = Flight::request()->data->getData();
        if (!is_array($data)) {
            throw new ValidationException('The request body must be a JSON object.');
        }

        return $data;
    }
}
