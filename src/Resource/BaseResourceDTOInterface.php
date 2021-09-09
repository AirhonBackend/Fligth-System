<?php

namespace App\Resource;

use Symfony\Component\HttpFoundation\JsonResponse;

interface BaseResourceDTOInterface
{
    public function toJson(): JsonResponse;

    public static function fromCollection($dataCollection): JsonResponse;
}
