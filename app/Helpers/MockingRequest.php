<?php


namespace App\Helpers;


use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class MockingRequest
{

    public static function createRequest(array $data) : Request
    {
        $request = new Request;
        return $request->createFromBase(
            SymfonyRequest::create(
                $data['uri'], $data['method'], $data['parameters'], $data['cookies'], $data['files'], $data['server'], $data['content']
            )
        );
    }
}
