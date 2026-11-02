<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/Database.php';

abstract class BaseDao
{
    protected PDO $connection;

    protected function __construct(
        private readonly string $tableName,
        private readonly string $primaryKey,
        private readonly array $fillable
    ) {
        $this->connection = Database::connection();
    }

    public function getAll(): array
    {
        $sql = sprintf(
            'SELECT * FROM `%s` ORDER BY `%s`',
            $this->tableName,
            $this->primaryKey
        );
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getById(int $id): ?array
    {
        $sql = sprintf(
            'SELECT * FROM `%s` WHERE `%s` = :record_id',
            $this->tableName,
            $this->primaryKey
        );
        $statement = $this->connection->prepare($sql);
        $statement->execute(['record_id' => $id]);
        $record = $statement->fetch();

        return $record === false ? null : $record;
    }

    public function create(array $data): array
    {
        $data = $this->validatedData($data);
        $columns = array_keys($data);
        $columnList = implode(', ', array_map(static fn (string $column): string => "`{$column}`", $columns));
        $placeholders = implode(', ', array_map(static fn (string $column): string => ":{$column}", $columns));
        $sql = sprintf('INSERT INTO `%s` (%s) VALUES (%s)', $this->tableName, $columnList, $placeholders);

        $statement = $this->connection->prepare($sql);
        $statement->execute($data);

        $record = $this->getById((int) $this->connection->lastInsertId());
        if ($record === null) {
            throw new RuntimeException('The inserted record could not be read back.');
        }

        return $record;
    }

    public function update(int $id, array $data): bool
    {
        $data = $this->validatedData($data);
        $assignments = [];
        foreach (array_keys($data) as $column) {
            $assignments[] = sprintf('`%s` = :%s', $column, $column);
        }

        $sql = sprintf(
            'UPDATE `%s` SET %s WHERE `%s` = :record_id',
            $this->tableName,
            implode(', ', $assignments),
            $this->primaryKey
        );
        $data['record_id'] = $id;

        $statement = $this->connection->prepare($sql);
        $statement->execute($data);

        return $statement->rowCount() > 0;
    }

    public function delete(int $id): bool
    {
        $sql = sprintf(
            'DELETE FROM `%s` WHERE `%s` = :record_id',
            $this->tableName,
            $this->primaryKey
        );
        $statement = $this->connection->prepare($sql);
        $statement->execute(['record_id' => $id]);

        return $statement->rowCount() > 0;
    }

    private function validatedData(array $data): array
    {
        if ($data === []) {
            throw new InvalidArgumentException('At least one field is required.');
        }

        foreach (array_keys($data) as $column) {
            if (!is_string($column) || !in_array($column, $this->fillable, true)) {
                throw new InvalidArgumentException('The data contains a field this DAO cannot write.');
            }
        }

        return $data;
    }
}
