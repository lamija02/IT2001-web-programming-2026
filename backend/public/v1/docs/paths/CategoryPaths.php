<?php
declare(strict_types=1);

use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/categories',
    tags: ['Categories'],
    responses: [
        new OA\Response(response: 200, description: 'Category list', content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/Category'))),
        new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
    ]
)]
#[OA\Post(
    path: '/categories',
    tags: ['Categories'],
    requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(ref: '#/components/schemas/CategoryInput')),
    responses: [
        new OA\Response(response: 201, description: 'Category created', content: new OA\JsonContent(ref: '#/components/schemas/Category')),
        new OA\Response(response: 400, description: 'Invalid category', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
    ]
)]
#[OA\Get(
    path: '/categories/{id}',
    tags: ['Categories'],
    parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer', minimum: 1))],
    responses: [
        new OA\Response(response: 200, description: 'Category found', content: new OA\JsonContent(ref: '#/components/schemas/Category')),
        new OA\Response(response: 404, description: 'Category not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
    ]
)]
#[OA\Put(
    path: '/categories/{id}',
    tags: ['Categories'],
    parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer', minimum: 1))],
    requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(ref: '#/components/schemas/CategoryInput')),
    responses: [
        new OA\Response(response: 200, description: 'Category updated', content: new OA\JsonContent(ref: '#/components/schemas/Category')),
        new OA\Response(response: 400, description: 'Invalid category', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 404, description: 'Category not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
    ]
)]
#[OA\Delete(
    path: '/categories/{id}',
    tags: ['Categories'],
    parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer', minimum: 1))],
    responses: [
        new OA\Response(response: 200, description: 'Category deleted', content: new OA\JsonContent(ref: '#/components/schemas/Message')),
        new OA\Response(response: 400, description: 'Category still has books', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 404, description: 'Category not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
    ]
)]
class CategoryPaths
{
}
