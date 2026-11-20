<?php
declare(strict_types=1);

require_once __DIR__ . '/../utils/exceptions.php';
require_once __DIR__ . '/../dao/BaseDao.php';

abstract class BaseService
{
    protected string $entityName = 'Entity';

    public function __construct(protected BaseDao $dao)
    {
    }

    public function getAll(): array
    {
        return $this->dao->getAll();
    }

    public function getById(int $id): array
    {
        $entity = $this->dao->getById($id);
        if ($entity === null) {
            throw new NotFoundException("{$this->entityName} not found.");
        }

        return $entity;
    }

    public function create(array $data): array
    {
        $this->validate($data);
        return $this->dao->create($data);
    }

    public function update(int $id, array $data): array
    {
        $this->getById($id);
        $this->validate($data, $id);
        $this->dao->update($id, $data);

        return $this->getById($id);
    }

    public function delete(int $id): void
    {
        $this->getById($id);
        $this->dao->delete($id);
    }

    abstract protected function validate(array $data, ?int $id = null): void;
}
