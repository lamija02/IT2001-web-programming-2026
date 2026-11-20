<?php
declare(strict_types=1);

use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/external/books',
    tags: ['External books'],
    parameters: [
        new OA\Parameter(
            name: 'q',
            in: 'query',
            required: true,
            description: 'Book title or author to search in Open Library.',
            schema: new OA\Schema(type: 'string', minLength: 2, maxLength: 120),
            example: 'The Little Prince'
        )
    ],
    responses: [
        new OA\Response(response: 200, description: 'External book matches', content: new OA\JsonContent(ref: '#/components/schemas/ExternalBookSearch')),
        new OA\Response(response: 400, description: 'Invalid search query', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
        new OA\Response(response: 503, description: 'External book service unavailable', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
    ]
)]
class BookLookupPaths
{
}
