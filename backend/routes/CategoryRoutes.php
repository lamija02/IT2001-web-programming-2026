<?php
declare(strict_types=1);

Flight::route('GET /categories', function (): void {
    Flight::json(Flight::category_service()->getAll());
});

Flight::route('GET /categories/@id:[0-9]+', function (string $id): void {
    Flight::json(Flight::category_service()->getById((int) $id));
});

Flight::route('POST /categories', function (): void {
    Flight::json(Flight::category_service()->create(RequestData::jsonBody()), 201);
});

Flight::route('PUT /categories/@id:[0-9]+', function (string $id): void {
    Flight::json(Flight::category_service()->update((int) $id, RequestData::jsonBody()));
});

Flight::route('DELETE /categories/@id:[0-9]+', function (string $id): void {
    Flight::category_service()->delete((int) $id);
    Flight::json(['message' => 'Category deleted.']);
});
