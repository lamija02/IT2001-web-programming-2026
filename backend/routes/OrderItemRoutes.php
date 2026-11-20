<?php
declare(strict_types=1);

Flight::route('GET /order-items', function (): void {
    Flight::json(Flight::order_item_service()->getAll());
});

Flight::route('GET /order-items/@id:[0-9]+', function (string $id): void {
    Flight::json(Flight::order_item_service()->getById((int) $id));
});

Flight::route('PUT /order-items/@id:[0-9]+', function (string $id): void {
    Flight::json(Flight::order_item_service()->update((int) $id, RequestData::jsonBody()));
});

Flight::route('DELETE /order-items/@id:[0-9]+', function (string $id): void {
    Flight::order_item_service()->delete((int) $id);
    Flight::json(['message' => 'Order item deleted.']);
});
