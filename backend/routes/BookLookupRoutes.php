<?php
declare(strict_types=1);

Flight::route('GET /external/books', function (): void {
    $query = (string) (Flight::request()->query['q'] ?? '');
    Flight::json(Flight::book_lookup_service()->search($query));
});
