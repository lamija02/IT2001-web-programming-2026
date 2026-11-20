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

    public static function text(mixed $value, string $field, int $min, int $max): string
    {
        if (!is_string($value)) {
            throw new ValidationException("Field '$field' must be text.");
        }

        $value = trim($value);
        self::length($value, $field, $min, $max);

        return $value;
    }

    public static function integer(mixed $value, string $field, int $min = 1, int $max = PHP_INT_MAX): int
    {
        $number = filter_var($value, FILTER_VALIDATE_INT);
        if ($number === false || $number < $min || $number > $max) {
            throw new ValidationException("Field '$field' must be a whole number between $min and $max.");
        }

        return $number;
    }

    public static function decimal(mixed $value, string $field, float $min, float $max): float
    {
        if (!is_numeric($value)) {
            throw new ValidationException("Field '$field' must be a number.");
        }

        $number = (float) $value;
        if (!is_finite($number) || $number < $min || $number > $max) {
            throw new ValidationException("Field '$field' must be between $min and $max.");
        }
        if (round($number, 2) !== $number) {
            throw new ValidationException("Field '$field' can have at most two decimal places.");
        }

        return round($number, 2);
    }

    public static function email(mixed $value): string
    {
        if (!is_string($value) || filter_var(trim($value), FILTER_VALIDATE_EMAIL) === false) {
            throw new ValidationException("Field 'email' must be a valid email address.");
        }

        return trim($value);
    }

    public static function oneOf(mixed $value, string $field, array $allowed): string
    {
        if (!is_string($value) || !in_array($value, $allowed, true)) {
            throw new ValidationException("Field '$field' must be one of: " . implode(', ', $allowed) . '.');
        }

        return $value;
    }
}
