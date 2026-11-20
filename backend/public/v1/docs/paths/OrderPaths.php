<?php
declare(strict_types=1);

use OpenApi\Attributes as OA;

#[OA\Get(path: '/orders', tags: ['Orders'], responses: [
    new OA\Response(response: 200, description: 'Order list', content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/Order'))),
    new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
])]
#[OA\Post(
    path: '/orders',
    tags: ['Orders'],
    requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(ref: '#/components/schemas/OrderInput')),
    responses: [
        new OA\Response(response: 201, description: 'Order created with its items', content: new OA\JsonContent(ref: '#/components/schemas/Order')),
        new OA\Response(response: 400, description: 'Invalid order', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
    ]
)]
#[OA\Get(
    path: '/orders/{id}',
    tags: ['Orders'],
    parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer', minimum: 1))],
    responses: [
        new OA\Response(response: 200, description: 'Order found', content: new OA\JsonContent(ref: '#/components/schemas/Order')),
        new OA\Response(response: 404, description: 'Order not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
    ]
)]
#[OA\Put(
    path: '/orders/{id}',
    tags: ['Orders'],
    parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer', minimum: 1))],
    requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(ref: '#/components/schemas/OrderStatusInput')),
    responses: [
        new OA\Response(response: 200, description: 'Order updated', content: new OA\JsonContent(ref: '#/components/schemas/Order')),
        new OA\Response(response: 400, description: 'Invalid order update', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 404, description: 'Order not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
    ]
)]
#[OA\Delete(
    path: '/orders/{id}',
    tags: ['Orders'],
    parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer', minimum: 1))],
    responses: [
        new OA\Response(response: 200, description: 'Order deleted', content: new OA\JsonContent(ref: '#/components/schemas/Message')),
        new OA\Response(response: 404, description: 'Order not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
    ]
)]
#[OA\Get(
    path: '/orders/{id}/items',
    tags: ['Orders'],
    parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer', minimum: 1))],
    responses: [
        new OA\Response(response: 200, description: 'Items in the order', content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/OrderItem'))),
        new OA\Response(response: 404, description: 'Order not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
    ]
)]
#[OA\Post(
    path: '/orders/{id}/items',
    tags: ['Orders'],
    parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer', minimum: 1))],
    requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(ref: '#/components/schemas/OrderItemInput')),
    responses: [
        new OA\Response(response: 201, description: 'Order item created', content: new OA\JsonContent(ref: '#/components/schemas/OrderItem')),
        new OA\Response(response: 400, description: 'Invalid order item or book reference', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 404, description: 'Order not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
    ]
)]
class OrderPaths
{
}
