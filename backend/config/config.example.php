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

    public static function OPEN_LIBRARY_SEARCH_URL(): string
    {
        return 'https://openlibrary.org/search.json';
    }

    public static function EXTERNAL_API_TIMEOUT(): int
    {
        return 5;
    }
}
