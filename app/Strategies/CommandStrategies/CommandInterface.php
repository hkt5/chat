<?php


namespace App\Strategies\CommandStrategies;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface CommandInterface
{

    public function command(Request $request) : JsonResponse;
}
