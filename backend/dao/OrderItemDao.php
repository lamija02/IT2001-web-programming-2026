<?php
declare(strict_types=1);

require_once __DIR__ . '/BaseDao.php';

final class OrderItemDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('order_items', 'order_item_id', ['order_id', 'book_id', 'quantity', 'unit_price']);
    }
}
