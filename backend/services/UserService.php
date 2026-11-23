<?php
declare(strict_types=1);

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/UserDao.php';
require_once __DIR__ . '/../dao/OrderDao.php';
require_once __DIR__ . '/../utils/Validator.php';

final class UserService extends BaseService
{
    protected string $entityName = 'User';
    private OrderDao $orderDao;

    public function __construct(?UserDao $userDao = null, ?OrderDao $orderDao = null)
    {
        parent::__construct($userDao ?? new UserDao());
        $this->orderDao = $orderDao ?? new OrderDao();
    }

    public function create(array $data): array
    {
        return parent::create($this->normalize($data));
    }

    public function update(int $id, array $data): array
    {
        return parent::update($id, $this->normalize($data));
    }

    public function delete(int $id): void
    {
        $this->getById($id);
        if ($this->orderDao->countByUser($id) > 0) {
            throw new ValidationException('This user has orders and cannot be deleted.');
        }

        $this->dao->delete($id);
    }

    protected function validate(array $data, ?int $id = null): void
    {
        if (array_diff(array_keys($data), ['full_name', 'email']) !== []) {
            throw new ValidationException('The user contains a field that cannot be changed.');
        }

        Validator::required($data, ['full_name', 'email']);
        Validator::text($data['full_name'], 'full_name', 1, 120);
        $email = Validator::email($data['email']);
        Validator::length($email, 'email', 1, 255);

        $existing = $this->dao->getByEmail($email);
        if ($existing !== null && (int) $existing['user_id'] !== $id) {
            throw new ValidationException('A user with this email address already exists.');
        }
    }

    private function normalize(array $data): array
    {
        if (isset($data['full_name']) && is_string($data['full_name'])) {
            $data['full_name'] = trim($data['full_name']);
        }
        if (isset($data['email']) && is_string($data['email'])) {
            $data['email'] = trim($data['email']);
        }

        return $data;
    }
}
