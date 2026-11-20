<?php
declare(strict_types=1);

require_once __DIR__ . '/BaseDao.php';

final class CategoryDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('categories', 'category_id', ['name', 'description']);
    }

    public function getByName(string $name): ?array
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM categories WHERE name = :name LIMIT 1'
        );
        $statement->execute(['name' => $name]);
        $category = $statement->fetch();

        return $category === false ? null : $category;
    }
}
