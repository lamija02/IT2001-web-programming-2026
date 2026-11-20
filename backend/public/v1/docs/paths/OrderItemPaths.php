<?php
declare(strict_types=1);

use OpenApi\Attributes as OA;

#[OA\Get(path: '/order-items', tags: ['Order items'], responses: [
    new OA\Response(response: 200, description: 'Order item list', content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/OrderItem'))),
    new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
])]
#[OA\Get(
    path: '/order-items/{id}',
    tags: ['Order items'],
    parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer', minimum: 1))],
    responses: [
        new OA\Response(response: 200, description: 'Order item found', content: new OA\JsonContent(ref: '#/components/schemas/OrderItem')),
        new OA\Response(response: 404, description: 'Order item not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
    ]
)]
#[OA\Put(
    path: '/order-items/{id}',
    tags: ['Order items'],
    parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer', minimum: 1))],
    requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(ref: '#/components/schemas/OrderItemQuantityInput')),
    responses: [
        new OA\Response(response: 200, description: 'Order item updated', content: new OA\JsonContent(ref: '#/components/schemas/OrderItem')),
        new OA\Response(response: 400, description: 'Invalid quantity', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 404, description: 'Order item not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
    ]
)]
#[OA\Delete(
    path: '/order-items/{id}',
    tags: ['Order items'],
    parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer', minimum: 1))],
    responses: [
        new OA\Response(response: 200, description: 'Order item deleted', content: new OA\JsonContent(ref: '#/components/schemas/Message')),
        new OA\Response(response: 400, description: 'Order must retain one item', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 404, description: 'Order item not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
    ]
)]
class OrderItemPaths
{
}
