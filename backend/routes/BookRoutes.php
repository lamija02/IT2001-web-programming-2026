<?php
declare(strict_types=1);

Flight::route('GET /books', function (): void {
    Flight::json(Flight::book_service()->getAll());
});

Flight::route('GET /books/@id:[0-9]+', function (string $id): void {
    Flight::json(Flight::book_service()->getById((int) $id));
});

Flight::route('POST /books', function (): void {
    Flight::json(Flight::book_service()->create(RequestData::jsonBody()), 201);
});

Flight::route('PUT /books/@id:[0-9]+', function (string $id): void {
    Flight::json(Flight::book_service()->update((int) $id, RequestData::jsonBody()));
});

Flight::route('DELETE /books/@id:[0-9]+', function (string $id): void {
    Flight::book_service()->delete((int) $id);
    Flight::json(['message' => 'Book deleted.']);
});
