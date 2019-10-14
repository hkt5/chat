<?php

namespace App\Strategies\QueryStrategies;

use Illuminate\Http\JsonResponse;

interface FindByIdQueryInterface
{

    public function findById(int $id) : JsonResponse;
}
