<?php

namespace App\Resource;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BaseResourceDTO implements BaseResourceDTOInterface
{
    public $data = [];

    public function toJson(): JsonResponse
    {
        return new JsonResponse($this->data);
    }

    public static function fromCollection($dataCollection): JsonResponse
    {
        $collection = [];
        foreach ($dataCollection as $dataEntity) {
            $entity = new static($dataEntity);

            $collection[] = $entity->data;
        }

        return new JsonResponse($collection);
    }
}
