<?php
declare(strict_types=1);

use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/',
    tags: ['General'],
    responses: [new OA\Response(response: 200, description: 'API status')]
)]
class GeneralPaths
{
}
