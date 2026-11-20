<?php
declare(strict_types=1);

$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$requestedFile = __DIR__ . (is_string($requestPath) ? $requestPath : '/');
if (PHP_SAPI === 'cli-server' && $requestPath !== '/' && (is_file($requestedFile) || is_dir($requestedFile))) {
    return false;
}

if (!is_file(__DIR__ . '/config/config.php')) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    exit('Missing backend/config/config.php. Copy config.example.php to config.php and set your database credentials.');
}

require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/utils/exceptions.php';
require_once __DIR__ . '/utils/RequestData.php';
require_once __DIR__ . '/services/CategoryService.php';
require_once __DIR__ . '/services/BookService.php';
require_once __DIR__ . '/services/UserService.php';
require_once __DIR__ . '/services/OrderService.php';
require_once __DIR__ . '/services/OrderItemService.php';
require_once __DIR__ . '/services/BookLookupService.php';
require_once __DIR__ . '/services/DashboardService.php';

Flight::register('category_service', 'CategoryService');
Flight::register('book_service', 'BookService');
Flight::register('user_service', 'UserService');
Flight::register('order_service', 'OrderService');
Flight::register('order_item_service', 'OrderItemService');
Flight::register('book_lookup_service', 'BookLookupService');
Flight::register('dashboard_service', 'DashboardService');

Flight::map('error', function (Throwable $exception): void {
    if ($exception instanceof HttpException) {
        $status = $exception->getStatusCode();
        $message = $exception->getMessage();
    } else {
        $status = 500;
        $message = 'Something went wrong on the server. Please try again later.';
        error_log((string) $exception . PHP_EOL, 3, __DIR__ . '/logs/error.log');
    }

    Flight::response()
        ->clearBody()
        ->status($status)
        ->header('Content-Type', 'application/json')
        ->write(json_encode(
            ['status' => $status, 'error' => $message],
            JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE
        ))
        ->send();
});

Flight::map('notFound', function (): void {
    $request = Flight::request();
    $method = $request->method;
    $url = strtok((string) $request->url, '?');

    Flight::response()
        ->clearBody()
        ->status(404)
        ->header('Content-Type', 'application/json')
        ->write(json_encode([
            'status' => 404,
            'error' => "Endpoint $method $url does not exist.",
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_INVALID_UTF8_SUBSTITUTE))
        ->send();
});

Flight::route('GET /', function (): void {
    Flight::json([
        'app' => 'OnlineBookstore API',
        'message' => 'The backend is running.',
        'docs' => 'public/v1/docs/',
    ]);
});

require_once __DIR__ . '/routes/CategoryRoutes.php';
require_once __DIR__ . '/routes/BookRoutes.php';
require_once __DIR__ . '/routes/UserRoutes.php';
require_once __DIR__ . '/routes/OrderRoutes.php';
require_once __DIR__ . '/routes/OrderItemRoutes.php';
require_once __DIR__ . '/routes/BookLookupRoutes.php';
require_once __DIR__ . '/routes/DashboardRoutes.php';

Flight::start();
