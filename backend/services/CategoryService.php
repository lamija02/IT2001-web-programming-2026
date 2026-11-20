<?php
declare(strict_types=1);

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/CategoryDao.php';
require_once __DIR__ . '/../dao/BookDao.php';
require_once __DIR__ . '/../utils/Validator.php';

final class CategoryService extends BaseService
{
    protected string $entityName = 'Category';
    private BookDao $bookDao;

    public function __construct(?CategoryDao $categoryDao = null, ?BookDao $bookDao = null)
    {
        parent::__construct($categoryDao ?? new CategoryDao());
        $this->bookDao = $bookDao ?? new BookDao();
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
        $bookCount = $this->bookDao->countByCategory($id);
        if ($bookCount > 0) {
            throw new ValidationException("This category still contains $bookCount book(s). Move or delete them first.");
        }

        $this->dao->delete($id);
    }

    protected function validate(array $data, ?int $id = null): void
    {
        $unexpectedFields = array_diff(array_keys($data), ['name', 'description']);
        if ($unexpectedFields !== []) {
            throw new ValidationException('The category contains a field that cannot be changed.');
        }

        Validator::required($data, ['name']);
        if (!is_string($data['name'])) {
            throw new ValidationException("Field 'name' must be text.");
        }
        Validator::length($data['name'], 'name', 1, 80);

        if (array_key_exists('description', $data) && $data['description'] !== null) {
            if (!is_string($data['description'])) {
                throw new ValidationException("Field 'description' must be text.");
            }
            Validator::length($data['description'], 'description', 0, 255);
        }

        $existing = $this->dao->getByName($data['name']);
        if ($existing !== null && (int) $existing['category_id'] !== $id) {
            throw new ValidationException("A category named '{$data['name']}' already exists.");
        }
    }

    private function normalize(array $data): array
    {
        if (isset($data['name']) && is_string($data['name'])) {
            $data['name'] = trim($data['name']);
        }

        if (array_key_exists('description', $data) && is_string($data['description'])) {
            $data['description'] = trim($data['description']);
            if ($data['description'] === '') {
                $data['description'] = null;
            }
        }

        return $data;
    }
}
