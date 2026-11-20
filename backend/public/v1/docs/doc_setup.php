<?php
declare(strict_types=1);

use OpenApi\Attributes as OA;

#[OA\Info(
    title: 'OnlineBookstore API',
    description: 'REST API for the OnlineBookstore application.',
    version: '1.0.0'
)]
#[OA\Server(url: API_BASE_URL, description: 'Current server')]
#[OA\Schema(
    schema: 'Error',
    required: ['error'],
    properties: [new OA\Property(property: 'error', type: 'string', example: 'Book not found.')]
)]
#[OA\Schema(
    schema: 'Message',
    required: ['message'],
    properties: [new OA\Property(property: 'message', type: 'string', example: 'Book deleted.')]
)]
#[OA\Schema(
    schema: 'CategoryInput',
    required: ['name'],
    properties: [
        new OA\Property(property: 'name', type: 'string', maxLength: 80, example: 'Classics'),
        new OA\Property(property: 'description', type: 'string', nullable: true, maxLength: 255, example: 'Classic fiction.')
    ]
)]
#[OA\Schema(
    schema: 'Category',
    allOf: [new OA\Schema(ref: '#/components/schemas/CategoryInput')],
    properties: [new OA\Property(property: 'category_id', type: 'integer', example: 1)]
)]
#[OA\Schema(
    schema: 'BookInput',
    required: ['title', 'author', 'price', 'category_id'],
    properties: [
        new OA\Property(property: 'title', type: 'string', maxLength: 180, example: 'The Little Prince'),
        new OA\Property(property: 'author', type: 'string', maxLength: 120, example: 'Antoine de Saint-Exupéry'),
        new OA\Property(property: 'description', type: 'string', nullable: true, example: 'A story about friendship.'),
        new OA\Property(property: 'price', type: 'number', format: 'float', minimum: 0, example: 12.99),
        new OA\Property(property: 'rating', type: 'number', format: 'float', nullable: true, minimum: 0, maximum: 5, example: 4.34),
        new OA\Property(property: 'category_id', type: 'integer', minimum: 1, example: 1)
    ]
)]
#[OA\Schema(
    schema: 'Book',
    allOf: [new OA\Schema(ref: '#/components/schemas/BookInput')],
    properties: [new OA\Property(property: 'book_id', type: 'integer', example: 1)]
)]
#[OA\Schema(
    schema: 'UserInput',
    required: ['full_name', 'email'],
    properties: [
        new OA\Property(property: 'full_name', type: 'string', maxLength: 120, example: 'Demo Reader'),
        new OA\Property(property: 'email', type: 'string', format: 'email', maxLength: 255, example: 'reader@example.com')
    ]
)]
#[OA\Schema(
    schema: 'User',
    allOf: [new OA\Schema(ref: '#/components/schemas/UserInput')],
    properties: [new OA\Property(property: 'user_id', type: 'integer', example: 1)]
)]
#[OA\Schema(
    schema: 'OrderItemInput',
    required: ['book_id', 'quantity'],
    properties: [
        new OA\Property(property: 'book_id', type: 'integer', minimum: 1, example: 1),
        new OA\Property(property: 'quantity', type: 'integer', minimum: 1, example: 2)
    ]
)]
#[OA\Schema(
    schema: 'OrderInput',
    required: ['user_id', 'items'],
    properties: [
        new OA\Property(property: 'user_id', type: 'integer', minimum: 1, example: 1),
        new OA\Property(property: 'status', type: 'string', enum: ['pending', 'completed', 'cancelled'], example: 'pending'),
        new OA\Property(
            property: 'items',
            type: 'array',
            minItems: 1,
            items: new OA\Items(ref: '#/components/schemas/OrderItemInput')
        )
    ]
)]
#[OA\Schema(
    schema: 'OrderItem',
    properties: [
        new OA\Property(property: 'order_item_id', type: 'integer', example: 1),
        new OA\Property(property: 'order_id', type: 'integer', example: 1),
        new OA\Property(property: 'book_id', type: 'integer', example: 1),
        new OA\Property(property: 'quantity', type: 'integer', example: 2),
        new OA\Property(property: 'unit_price', type: 'number', format: 'float', example: 12.99)
    ]
)]
#[OA\Schema(
    schema: 'Order',
    properties: [
        new OA\Property(property: 'order_id', type: 'integer', example: 1),
        new OA\Property(property: 'user_id', type: 'integer', example: 1),
        new OA\Property(property: 'status', type: 'string', enum: ['pending', 'completed', 'cancelled'], example: 'completed'),
        new OA\Property(property: 'ordered_at', type: 'string', format: 'date-time'),
        new OA\Property(property: 'items', type: 'array', items: new OA\Items(ref: '#/components/schemas/OrderItem'))
    ]
)]
#[OA\Schema(
    schema: 'OrderStatusInput',
    properties: [
        new OA\Property(property: 'user_id', type: 'integer', minimum: 1, example: 1),
        new OA\Property(property: 'status', type: 'string', enum: ['pending', 'completed', 'cancelled'], example: 'completed')
    ]
)]
#[OA\Schema(
    schema: 'OrderItemQuantityInput',
    required: ['quantity'],
    properties: [new OA\Property(property: 'quantity', type: 'integer', minimum: 1, example: 2)]
)]
#[OA\Schema(
    schema: 'ExternalBook',
    properties: [
        new OA\Property(property: 'title', type: 'string', example: 'The Little Prince'),
        new OA\Property(property: 'authors', type: 'array', items: new OA\Items(type: 'string')),
        new OA\Property(property: 'first_publish_year', type: 'integer', nullable: true, example: 1943),
        new OA\Property(property: 'work_key', type: 'string', nullable: true, example: '/works/OL12345W'),
        new OA\Property(property: 'cover_id', type: 'integer', nullable: true, example: 123456)
    ]
)]
#[OA\Schema(
    schema: 'ExternalBookSearch',
    properties: [
        new OA\Property(property: 'query', type: 'string', example: 'The Little Prince'),
        new OA\Property(
            property: 'results',
            type: 'array',
            items: new OA\Items(ref: '#/components/schemas/ExternalBook')
        )
    ]
)]
#[OA\Schema(
    schema: 'Dashboard',
    properties: [
        new OA\Property(property: 'users', type: 'integer', example: 1),
        new OA\Property(property: 'books', type: 'integer', example: 14),
        new OA\Property(property: 'categories', type: 'integer', example: 4),
        new OA\Property(property: 'orders', type: 'integer', example: 1),
        new OA\Property(property: 'pending_orders', type: 'integer', example: 0),
        new OA\Property(property: 'order_items', type: 'integer', example: 2)
    ]
)]
class OpenApiSpec
{
}
