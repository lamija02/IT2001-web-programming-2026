<?php
declare(strict_types=1);

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/OrderItemDao.php';
require_once __DIR__ . '/../dao/OrderDao.php';
require_once __DIR__ . '/../dao/BookDao.php';
require_once __DIR__ . '/../utils/Validator.php';

final class OrderItemService extends BaseService
{
    protected string $entityName = 'Order item';
    private OrderDao $orderDao;
    private BookDao $bookDao;

    public function __construct(
        ?OrderItemDao $orderItemDao = null,
        ?OrderDao $orderDao = null,
        ?BookDao $bookDao = null
    ) {
        parent::__construct($orderItemDao ?? new OrderItemDao());
        $this->orderDao = $orderDao ?? new OrderDao();
        $this->bookDao = $bookDao ?? new BookDao();
    }

    public function create(array $data): array
    {
        if (!array_key_exists('order_id', $data)) {
            throw new ValidationException("Field 'order_id' is required.");
        }

        $orderId = Validator::integer($data['order_id'], 'order_id');
        unset($data['order_id']);
        return $this->createForOrder($orderId, $data);
    }

    public function createForOrder(int $orderId, array $data): array
    {
        if (array_key_exists('order_id', $data)) {
            throw new ValidationException("Field 'order_id' must come from the order URL.");
        }
        $this->getOrder($orderId);
        $data['order_id'] = $orderId;
        $data = $this->normalizeForCreate($data);

        return parent::create($data);
    }

    public function update(int $id, array $data): array
    {
        if (array_diff(array_keys($data), ['quantity']) !== []) {
            throw new ValidationException('Only the quantity of an order item can be changed.');
        }

        return parent::update($id, $data);
    }

    public function delete(int $id): void
    {
        $item = $this->getById($id);
        if ($this->dao->countByOrder((int) $item['order_id']) <= 1) {
            throw new ValidationException('An order must contain at least one item.');
        }

        $this->dao->delete($id);
    }

    protected function validate(array $data, ?int $id = null): void
    {
        $allowedFields = $id === null
            ? ['order_id', 'book_id', 'quantity', 'unit_price']
            : ['quantity'];
        if (array_diff(array_keys($data), $allowedFields) !== []) {
            throw new ValidationException('The order item contains a field that cannot be changed.');
        }

        Validator::required($data, $id === null ? ['order_id', 'book_id', 'quantity', 'unit_price'] : ['quantity']);
        if ($id === null) {
            Validator::integer($data['order_id'], 'order_id');
            Validator::integer($data['book_id'], 'book_id');
            Validator::decimal($data['unit_price'], 'unit_price', 0, 99999999.99);
        }
        Validator::integer($data['quantity'], 'quantity');
    }

    private function normalizeForCreate(array $data): array
    {
        if (array_diff(array_keys($data), ['order_id', 'book_id', 'quantity']) !== []) {
            throw new ValidationException('Only book_id and quantity can be provided for an order item.');
        }

        Validator::required($data, ['order_id', 'book_id', 'quantity']);
        $bookId = Validator::integer($data['book_id'], 'book_id');
        $book = $this->bookDao->getById($bookId);
        if ($book === null) {
            throw new ValidationException("Book $bookId does not exist.");
        }

        if ($this->dao->getByOrderAndBook((int) $data['order_id'], $bookId) !== null) {
            throw new ValidationException('This book is already in the order. Increase its quantity instead.');
        }

        return [
            'order_id' => (int) $data['order_id'],
            'book_id' => $bookId,
            'quantity' => Validator::integer($data['quantity'], 'quantity'),
            'unit_price' => (float) $book['price'],
        ];
    }

    private function getOrder(int $orderId): array
    {
        $order = $this->orderDao->getById($orderId);
        if ($order === null) {
            throw new NotFoundException('Order not found.');
        }

        return $order;
    }
}
