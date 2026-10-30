<?php
declare(strict_types=1);

require_once __DIR__ . '/BaseDao.php';

final class OrderDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('orders', 'order_id', ['user_id', 'status', 'ordered_at']);
    }
}
