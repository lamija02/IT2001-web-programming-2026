<?php
declare(strict_types=1);

Flight::route('GET /dashboard', function (): void {
    Flight::json(Flight::dashboard_service()->summary());
});
