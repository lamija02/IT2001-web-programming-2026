<?php
declare(strict_types=1);

Flight::route('GET /orders', function (): void {
    Flight::json(Flight::order_service()->getAll());
});

Flight::route('GET /orders/@id:[0-9]+/items', function (string $id): void {
    Flight::json(Flight::order_service()->getItems((int) $id));
});

Flight::route('POST /orders/@id:[0-9]+/items', function (string $id): void {
    Flight::json(
        Flight::order_item_service()->createForOrder((int) $id, RequestData::jsonBody()),
        201
    );
});

Flight::route('GET /orders/@id:[0-9]+', function (string $id): void {
    Flight::json(Flight::order_service()->getById((int) $id));
});

Flight::route('POST /orders', function (): void {
    Flight::json(Flight::order_service()->create(RequestData::jsonBody()), 201);
});

Flight::route('PUT /orders/@id:[0-9]+', function (string $id): void {
    Flight::json(Flight::order_service()->update((int) $id, RequestData::jsonBody()));
});

Flight::route('DELETE /orders/@id:[0-9]+', function (string $id): void {
    Flight::order_service()->delete((int) $id);
    Flight::json(['message' => 'Order deleted.']);
});
