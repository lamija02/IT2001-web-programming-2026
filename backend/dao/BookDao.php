<?php
declare(strict_types=1);

require_once __DIR__ . '/BaseDao.php';

final class BookDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('books', 'book_id', ['title', 'author', 'description', 'price', 'rating', 'category_id']);
    }
}
