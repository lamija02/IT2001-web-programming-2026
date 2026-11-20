<?php
declare(strict_types=1);

require_once __DIR__ . '/BaseDao.php';

final class UserDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('users', 'user_id', ['full_name', 'email']);
    }

    public function getByEmail(string $email): ?array
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM users WHERE email = :email LIMIT 1'
        );
        $statement->execute(['email' => $email]);
        $user = $statement->fetch();

        return $user === false ? null : $user;
    }
}
