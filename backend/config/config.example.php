<?php
declare(strict_types=1);

final class Config
{
    public static function DB_HOST(): string
    {
        return '127.0.0.1';
    }

    public static function DB_PORT(): int
    {
        return 3306;
    }

    public static function DB_NAME(): string
    {
        return 'online_bookstore';
    }

    public static function DB_USER(): string
    {
        return 'root';
    }

    public static function DB_PASSWORD(): string
    {
        return '';
    }
}
