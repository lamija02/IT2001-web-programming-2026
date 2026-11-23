<?php
declare(strict_types=1);

use OpenApi\Attributes as OA;

#[OA\Get(path: '/users', tags: ['Users'], responses: [
    new OA\Response(response: 200, description: 'User list', content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/User'))),
    new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
])]
#[OA\Post(
    path: '/users',
    tags: ['Users'],
    requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(ref: '#/components/schemas/UserInput')),
    responses: [
        new OA\Response(response: 201, description: 'User created', content: new OA\JsonContent(ref: '#/components/schemas/User')),
        new OA\Response(response: 400, description: 'Invalid user', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
    ]
)]
#[OA\Get(
    path: '/users/{id}',
    tags: ['Users'],
    parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer', minimum: 1))],
    responses: [
        new OA\Response(response: 200, description: 'User found', content: new OA\JsonContent(ref: '#/components/schemas/User')),
        new OA\Response(response: 404, description: 'User not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
    ]
)]
#[OA\Put(
    path: '/users/{id}',
    tags: ['Users'],
    parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer', minimum: 1))],
    requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(ref: '#/components/schemas/UserInput')),
    responses: [
        new OA\Response(response: 200, description: 'User updated', content: new OA\JsonContent(ref: '#/components/schemas/User')),
        new OA\Response(response: 400, description: 'Invalid user', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 404, description: 'User not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
    ]
)]
#[OA\Delete(
    path: '/users/{id}',
    tags: ['Users'],
    parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer', minimum: 1))],
    responses: [
        new OA\Response(response: 200, description: 'User deleted', content: new OA\JsonContent(ref: '#/components/schemas/Message')),
        new OA\Response(response: 400, description: 'User has orders', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 404, description: 'User not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
    ]
)]
class UserPaths
{
}
