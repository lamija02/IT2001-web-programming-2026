<?php
declare(strict_types=1);

class HttpException extends RuntimeException
{
    public function __construct(
        string $message,
        private readonly int $statusCode = 500,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, 0, $previous);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}

class ValidationException extends HttpException
{
    public function __construct(string $message)
    {
        parent::__construct($message, 400);
    }
}

class UnauthorizedException extends HttpException
{
    public function __construct(string $message)
    {
        parent::__construct($message, 401);
    }
}

class ForbiddenException extends HttpException
{
    public function __construct(string $message)
    {
        parent::__construct($message, 403);
    }
}

class NotFoundException extends HttpException
{
    public function __construct(string $message)
    {
        parent::__construct($message, 404);
    }
}

class ExternalServiceException extends HttpException
{
    public function __construct(string $message)
    {
        parent::__construct($message, 503);
    }
}
