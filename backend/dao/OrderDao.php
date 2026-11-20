<?php
declare(strict_types=1);

require_once __DIR__ . '/BaseDao.php';

final class OrderDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('orders', 'order_id', ['user_id', 'status', 'ordered_at']);
    }

    public function countByUser(int $userId): int
    {
        $statement = $this->connection->prepare(
            'SELECT COUNT(*) FROM orders WHERE user_id = :user_id'
        );
        $statement->execute(['user_id' => $userId]);

        return (int) $statement->fetchColumn();
    }

    public function countByStatus(string $status): int
    {
        $statement = $this->connection->prepare(
            'SELECT COUNT(*) FROM orders WHERE status = :status'
        );
        $statement->execute(['status' => $status]);

        return (int) $statement->fetchColumn();
    }
}
