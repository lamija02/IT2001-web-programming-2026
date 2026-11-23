<?php
declare(strict_types=1);

Flight::route('GET /users', function (): void {
    Flight::json(Flight::user_service()->getAll());
});

Flight::route('GET /users/@id:[0-9]+', function (string $id): void {
    Flight::json(Flight::user_service()->getById((int) $id));
});

Flight::route('POST /users', function (): void {
    Flight::json(Flight::user_service()->create(RequestData::jsonBody()), 201);
});

Flight::route('PUT /users/@id:[0-9]+', function (string $id): void {
    Flight::json(Flight::user_service()->update((int) $id, RequestData::jsonBody()));
});

Flight::route('DELETE /users/@id:[0-9]+', function (string $id): void {
    Flight::user_service()->delete((int) $id);
    Flight::json(['message' => 'User deleted.']);
});
