<?php
declare(strict_types=1);

require_once __DIR__ . '/../dao/UserDao.php';
require_once __DIR__ . '/../dao/BookDao.php';
require_once __DIR__ . '/../dao/CategoryDao.php';
require_once __DIR__ . '/../dao/OrderDao.php';
require_once __DIR__ . '/../dao/OrderItemDao.php';

final class DashboardService
{
    private UserDao $userDao;
    private BookDao $bookDao;
    private CategoryDao $categoryDao;
    private OrderDao $orderDao;
    private OrderItemDao $orderItemDao;

    public function __construct(
        ?UserDao $userDao = null,
        ?BookDao $bookDao = null,
        ?CategoryDao $categoryDao = null,
        ?OrderDao $orderDao = null,
        ?OrderItemDao $orderItemDao = null
    ) {
        $this->userDao = $userDao ?? new UserDao();
        $this->bookDao = $bookDao ?? new BookDao();
        $this->categoryDao = $categoryDao ?? new CategoryDao();
        $this->orderDao = $orderDao ?? new OrderDao();
        $this->orderItemDao = $orderItemDao ?? new OrderItemDao();
    }

    public function summary(): array
    {
        return [
            'users' => $this->userDao->countAll(),
            'books' => $this->bookDao->countAll(),
            'categories' => $this->categoryDao->countAll(),
            'orders' => $this->orderDao->countAll(),
            'pending_orders' => $this->orderDao->countByStatus('pending'),
            'order_items' => $this->orderItemDao->countAll(),
        ];
    }
}
