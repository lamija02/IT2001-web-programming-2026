<?php
declare(strict_types=1);

use OpenApi\Attributes as OA;

#[OA\Get(path: '/books', tags: ['Books'], responses: [
    new OA\Response(response: 200, description: 'Book list', content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/Book'))),
    new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
])]
#[OA\Post(
    path: '/books',
    tags: ['Books'],
    requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(ref: '#/components/schemas/BookInput')),
    responses: [
        new OA\Response(response: 201, description: 'Book created', content: new OA\JsonContent(ref: '#/components/schemas/Book')),
        new OA\Response(response: 400, description: 'Invalid book', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
    ]
)]
#[OA\Get(
    path: '/books/{id}',
    tags: ['Books'],
    parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer', minimum: 1))],
    responses: [
        new OA\Response(response: 200, description: 'Book found', content: new OA\JsonContent(ref: '#/components/schemas/Book')),
        new OA\Response(response: 404, description: 'Book not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
    ]
)]
#[OA\Put(
    path: '/books/{id}',
    tags: ['Books'],
    parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer', minimum: 1))],
    requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(ref: '#/components/schemas/BookInput')),
    responses: [
        new OA\Response(response: 200, description: 'Book updated', content: new OA\JsonContent(ref: '#/components/schemas/Book')),
        new OA\Response(response: 400, description: 'Invalid book', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 404, description: 'Book not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
    ]
)]
#[OA\Delete(
    path: '/books/{id}',
    tags: ['Books'],
    parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer', minimum: 1))],
    responses: [
        new OA\Response(response: 200, description: 'Book deleted', content: new OA\JsonContent(ref: '#/components/schemas/Message')),
        new OA\Response(response: 400, description: 'Book is used by an order', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 404, description: 'Book not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
    ]
)]
class BookPaths
{
}
