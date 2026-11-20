<?php
declare(strict_types=1);

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../dao/OrderDao.php';
require_once __DIR__ . '/../dao/OrderItemDao.php';
require_once __DIR__ . '/../dao/BookDao.php';
require_once __DIR__ . '/../dao/UserDao.php';
require_once __DIR__ . '/../utils/Validator.php';

final class OrderService extends BaseService
{
    protected string $entityName = 'Order';
    private OrderItemDao $orderItemDao;
    private BookDao $bookDao;
    private UserDao $userDao;
    private PDO $connection;

    public function __construct(
        ?OrderDao $orderDao = null,
        ?OrderItemDao $orderItemDao = null,
        ?BookDao $bookDao = null,
        ?UserDao $userDao = null,
        ?PDO $connection = null
    ) {
        parent::__construct($orderDao ?? new OrderDao());
        $this->orderItemDao = $orderItemDao ?? new OrderItemDao();
        $this->bookDao = $bookDao ?? new BookDao();
        $this->userDao = $userDao ?? new UserDao();
        $this->connection = $connection ?? Database::connection();
    }

    public function create(array $data): array
    {
        $this->validate($data);
        $items = $this->normalizeItems($data['items']);
        $orderData = ['user_id' => (int) $data['user_id']];
        if (isset($data['status'])) {
            $orderData['status'] = $data['status'];
        }

        $this->connection->beginTransaction();
        try {
            $order = $this->dao->create($orderData);
            foreach ($items as $item) {
                $this->orderItemDao->create([
                    'order_id' => (int) $order['order_id'],
                    'book_id' => $item['book_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                ]);
            }
            $this->connection->commit();
        } catch (Throwable $exception) {
            if ($this->connection->inTransaction()) {
                $this->connection->rollBack();
            }
            throw $exception;
        }

        $order['items'] = $this->orderItemDao->getByOrderId((int) $order['order_id']);
        return $order;
    }

    public function getAll(): array
    {
        $orders = $this->dao->getAll();
        foreach ($orders as &$order) {
            $order['items'] = $this->orderItemDao->getByOrderId((int) $order['order_id']);
        }
        unset($order);

        return $orders;
    }

    public function getById(int $id): array
    {
        $order = parent::getById($id);
        $order['items'] = $this->orderItemDao->getByOrderId($id);

        return $order;
    }

    public function update(int $id, array $data): array
    {
        return parent::update($id, $data);
    }

    public function getItems(int $id): array
    {
        return $this->getById($id)['items'];
    }

    protected function validate(array $data, ?int $id = null): void
    {
        $allowedFields = $id === null ? ['user_id', 'status', 'items'] : ['user_id', 'status'];
        if (array_diff(array_keys($data), $allowedFields) !== []) {
            throw new ValidationException('The order contains a field that cannot be changed.');
        }

        if ($id === null) {
            Validator::required($data, ['user_id']);
            if (!array_key_exists('items', $data)) {
                throw new ValidationException("Field 'items' is required.");
            }
        } elseif ($data === []) {
            throw new ValidationException('At least one order field must be provided.');
        }

        if (array_key_exists('user_id', $data)) {
            $userId = Validator::integer($data['user_id'], 'user_id');
            if ($this->userDao->getById($userId) === null) {
                throw new ValidationException('The selected user does not exist.');
            }
        }

        if (array_key_exists('status', $data)) {
            Validator::oneOf($data['status'], 'status', ['pending', 'completed', 'cancelled']);
        }

        if ($id === null && (!is_array($data['items']) || $data['items'] === [])) {
            throw new ValidationException('An order must contain at least one item.');
        }
    }

    private function normalizeItems(array $items): array
    {
        $normalized = [];
        $seenBookIds = [];

        foreach ($items as $item) {
            if (!is_array($item) || array_diff(array_keys($item), ['book_id', 'quantity']) !== []) {
                throw new ValidationException('Each order item must contain only book_id and quantity.');
            }

            Validator::required($item, ['book_id', 'quantity']);
            $bookId = Validator::integer($item['book_id'], 'book_id');
            $quantity = Validator::integer($item['quantity'], 'quantity');
            if (isset($seenBookIds[$bookId])) {
                throw new ValidationException('A book can appear only once in an order. Increase its quantity instead.');
            }

            $book = $this->bookDao->getById($bookId);
            if ($book === null) {
                throw new ValidationException("Book $bookId does not exist.");
            }

            $seenBookIds[$bookId] = true;
            $normalized[] = [
                'book_id' => $bookId,
                'quantity' => $quantity,
                'unit_price' => (float) $book['price'],
            ];
        }

        return $normalized;
    }
}
