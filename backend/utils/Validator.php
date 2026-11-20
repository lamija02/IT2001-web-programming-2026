<?php
declare(strict_types=1);

require_once __DIR__ . '/exceptions.php';

final class Validator
{
    public static function required(array $data, array $fields): void
    {
        foreach ($fields as $field) {
            if (!array_key_exists($field, $data) || !is_scalar($data[$field]) || trim((string) $data[$field]) === '') {
                throw new ValidationException("Field '$field' is required.");
            }
        }
    }

    public static function length(string $value, string $field, int $min, int $max): void
    {
        $length = mb_strlen(trim($value));
        if ($length < $min || $length > $max) {
            throw new ValidationException("Field '$field' must be between $min and $max characters long.");
        }
    }
}
