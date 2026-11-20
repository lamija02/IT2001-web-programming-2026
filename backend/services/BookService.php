<?php
declare(strict_types=1);

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/BookDao.php';
require_once __DIR__ . '/../dao/CategoryDao.php';
require_once __DIR__ . '/../utils/Validator.php';

final class BookService extends BaseService
{
    protected string $entityName = 'Book';
    private CategoryDao $categoryDao;

    public function __construct(?BookDao $bookDao = null, ?CategoryDao $categoryDao = null)
    {
        parent::__construct($bookDao ?? new BookDao());
        $this->categoryDao = $categoryDao ?? new CategoryDao();
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
        if ($this->dao->countByOrderItems($id) > 0) {
            throw new ValidationException('This book appears in an order and cannot be deleted.');
        }

        $this->dao->delete($id);
    }

    protected function validate(array $data, ?int $id = null): void
    {
        $allowedFields = ['title', 'author', 'description', 'price', 'rating', 'category_id'];
        if (array_diff(array_keys($data), $allowedFields) !== []) {
            throw new ValidationException('The book contains a field that cannot be changed.');
        }

        Validator::required($data, ['title', 'author', 'price', 'category_id']);
        Validator::text($data['title'], 'title', 1, 180);
        Validator::text($data['author'], 'author', 1, 120);
        Validator::decimal($data['price'], 'price', 0, 99999999.99);

        if (isset($data['rating'])) {
            Validator::decimal($data['rating'], 'rating', 0, 5);
        }

        if (array_key_exists('description', $data) && $data['description'] !== null && !is_string($data['description'])) {
            throw new ValidationException("Field 'description' must be text.");
        }

        $categoryId = Validator::integer($data['category_id'], 'category_id');
        if ($this->categoryDao->getById($categoryId) === null) {
            throw new ValidationException('The selected category does not exist.');
        }
    }

    private function normalize(array $data): array
    {
        foreach (['title', 'author'] as $field) {
            if (isset($data[$field]) && is_string($data[$field])) {
                $data[$field] = trim($data[$field]);
            }
        }

        if (isset($data['description']) && is_string($data['description'])) {
            $data['description'] = trim($data['description']);
            if ($data['description'] === '') {
                $data['description'] = null;
            }
        }
        if (isset($data['rating']) && $data['rating'] === '') {
            $data['rating'] = null;
        }
        return $data;
    }
}
