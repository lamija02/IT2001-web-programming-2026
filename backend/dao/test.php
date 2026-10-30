<?php
declare(strict_types=1);

require_once __DIR__ . '/UserDao.php';
require_once __DIR__ . '/BookDao.php';
require_once __DIR__ . '/CategoryDao.php';
require_once __DIR__ . '/OrderDao.php';
require_once __DIR__ . '/OrderItemDao.php';

function ensure(bool $condition, string $message): void
{
    if (!$condition) {
        throw new RuntimeException($message);
    }
}

function containsId(array $rows, string $column, int $id): bool
{
    foreach ($rows as $row) {
        if ((int) $row[$column] === $id) {
            return true;
        }
    }

    return false;
}

$connection = Database::connection();
$connection->beginTransaction();

try {
    $suffix = bin2hex(random_bytes(4));

    $userDao = new UserDao();
    $bookDao = new BookDao();
    $categoryDao = new CategoryDao();
    $orderDao = new OrderDao();
    $orderItemDao = new OrderItemDao();

    $user = $userDao->create([
        'full_name' => 'DAO Test User ' . $suffix,
        'email' => 'dao-test-' . $suffix . '@example.com',
    ]);
    $category = $categoryDao->create([
        'name' => 'DAO Test ' . $suffix,
        'description' => 'Temporary DAO verification row',
    ]);
    $bookOne = $bookDao->create([
        'title' => 'DAO Test Book One ' . $suffix,
        'author' => 'DAO Test Author',
        'description' => null,
        'price' => 5.99,
        'rating' => 4.5,
        'category_id' => (int) $category['category_id'],
    ]);
    $bookTwo = $bookDao->create([
        'title' => 'DAO Test Book Two ' . $suffix,
        'author' => 'DAO Test Author',
        'description' => null,
        'price' => 6.99,
        'rating' => null,
        'category_id' => (int) $category['category_id'],
    ]);
    $order = $orderDao->create([
        'user_id' => (int) $user['user_id'],
        'status' => 'completed',
    ]);
    $orderItemOne = $orderItemDao->create([
        'order_id' => (int) $order['order_id'],
        'book_id' => (int) $bookOne['book_id'],
        'quantity' => 1,
        'unit_price' => 5.99,
    ]);
    $orderItemTwo = $orderItemDao->create([
        'order_id' => (int) $order['order_id'],
        'book_id' => (int) $bookTwo['book_id'],
        'quantity' => 1,
        'unit_price' => 6.99,
    ]);

    $rows = [
        [$userDao, $user, 'user_id'],
        [$categoryDao, $category, 'category_id'],
        [$bookDao, $bookOne, 'book_id'],
        [$orderDao, $order, 'order_id'],
        [$orderItemDao, $orderItemOne, 'order_item_id'],
    ];

    foreach ($rows as [$dao, $record, $key]) {
        $id = (int) $record[$key];
        ensure(containsId($dao->getAll(), $key, $id), 'getAll did not return the created row.');
        ensure($dao->getById($id) !== null, 'getById did not find the created row.');
    }

    ensure($userDao->update((int) $user['user_id'], ['full_name' => 'Updated DAO Test User']), 'User update failed.');
    ensure($userDao->getById((int) $user['user_id'])['full_name'] === 'Updated DAO Test User', 'User update was not saved.');
    ensure($categoryDao->update((int) $category['category_id'], ['description' => 'Updated temporary row']), 'Category update failed.');
    ensure($categoryDao->getById((int) $category['category_id'])['description'] === 'Updated temporary row', 'Category update was not saved.');
    ensure($bookDao->update((int) $bookOne['book_id'], ['price' => 7.25]), 'Book update failed.');
    ensure((float) $bookDao->getById((int) $bookOne['book_id'])['price'] === 7.25, 'Book update was not saved.');
    ensure($orderDao->update((int) $order['order_id'], ['status' => 'pending']), 'Order update failed.');
    ensure($orderDao->getById((int) $order['order_id'])['status'] === 'pending', 'Order update was not saved.');
    ensure($orderItemDao->update((int) $orderItemOne['order_item_id'], ['quantity' => 2]), 'Order item update failed.');
    ensure((int) $orderItemDao->getById((int) $orderItemOne['order_item_id'])['quantity'] === 2, 'Order item update was not saved.');

    $unknownFieldRejected = false;
    try {
        $categoryDao->create([
            'name' => 'Rejected DAO Test ' . $suffix,
            'hacker' => 'DROP TABLE users',
        ]);
    } catch (InvalidArgumentException) {
        $unknownFieldRejected = true;
    }
    ensure($unknownFieldRejected, 'The DAO accepted a field outside its allow-list.');

    ensure($orderItemDao->delete((int) $orderItemOne['order_item_id']), 'Order item delete failed.');
    ensure($orderItemDao->getById((int) $orderItemOne['order_item_id']) === null, 'Deleted order item still exists.');
    ensure($orderDao->delete((int) $order['order_id']), 'Order delete failed.');
    ensure($orderItemDao->getById((int) $orderItemTwo['order_item_id']) === null, 'Order item was not removed with its order.');
    ensure($bookDao->delete((int) $bookOne['book_id']), 'Book delete failed.');
    ensure($bookDao->getById((int) $bookOne['book_id']) === null, 'Deleted book still exists.');
    ensure($bookDao->delete((int) $bookTwo['book_id']), 'Second book delete failed.');
    ensure($categoryDao->delete((int) $category['category_id']), 'Category delete failed.');
    ensure($categoryDao->getById((int) $category['category_id']) === null, 'Deleted category still exists.');
    ensure($userDao->delete((int) $user['user_id']), 'User delete failed.');
    ensure($userDao->getById((int) $user['user_id']) === null, 'Deleted user still exists.');

    echo "DAO CRUD checks passed for all five entities.\n";
} finally {
    if ($connection->inTransaction()) {
        $connection->rollBack();
    }
}
