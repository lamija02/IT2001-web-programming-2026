<?php
declare(strict_types=1);

use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/dashboard',
    tags: ['General'],
    responses: [
        new OA\Response(response: 200, description: 'Bookstore totals', content: new OA\JsonContent(ref: '#/components/schemas/Dashboard')),
        new OA\Response(response: 500, description: 'Server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
    ]
)]
class DashboardPaths
{
}
