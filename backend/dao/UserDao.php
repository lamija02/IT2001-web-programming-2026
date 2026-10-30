<?php
declare(strict_types=1);

require_once __DIR__ . '/BaseDao.php';

final class UserDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('users', 'user_id', ['full_name', 'email']);
    }
}
