<?php
declare(strict_types=1);

require_once __DIR__ . '/BaseDao.php';

final class OrderDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('orders', 'order_id', ['user_id', 'status', 'ordered_at']);
    }

    public function create(array $data): array
    {
        $items = $data['items'] ?? null;
        unset($data['items']);

        if (!is_array($items) || $items === []) {
            throw new InvalidArgumentException('An order must contain at least one item.');
        }

        $startedTransaction = !$this->connection->inTransaction();
        if ($startedTransaction) {
            $this->connection->beginTransaction();
        }

        try {
            $order = parent::create($data);
            $orderItemDao = new OrderItemDao();

            foreach ($items as $item) {
                if (!is_array($item)) {
                    throw new InvalidArgumentException('Each order item must be an array.');
                }
                $item['order_id'] = (int) $order['order_id'];
                $orderItemDao->create($item);
            }

            if ($startedTransaction) {
                $this->connection->commit();
            }

            return $order;
        } catch (Throwable $exception) {
            if ($startedTransaction && $this->connection->inTransaction()) {
                $this->connection->rollBack();
            }
            throw $exception;
        }
    }
}
