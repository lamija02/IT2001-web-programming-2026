<?php
declare(strict_types=1);

require_once __DIR__ . '/BaseDao.php';

final class OrderItemDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('order_items', 'order_item_id', ['order_id', 'book_id', 'quantity', 'unit_price']);
    }

    public function countByOrder(int $orderId): int
    {
        $statement = $this->connection->prepare(
            'SELECT COUNT(*) FROM order_items WHERE order_id = :order_id'
        );
        $statement->execute(['order_id' => $orderId]);

        return (int) $statement->fetchColumn();
    }

    public function getByOrderId(int $orderId): array
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM order_items WHERE order_id = :order_id ORDER BY order_item_id'
        );
        $statement->execute(['order_id' => $orderId]);

        return $statement->fetchAll();
    }

    public function getByOrderAndBook(int $orderId, int $bookId): ?array
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM order_items WHERE order_id = :order_id AND book_id = :book_id LIMIT 1'
        );
        $statement->execute(['order_id' => $orderId, 'book_id' => $bookId]);
        $item = $statement->fetch();

        return $item === false ? null : $item;
    }
}
