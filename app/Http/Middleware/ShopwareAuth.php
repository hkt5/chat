<?php


namespace App\Http\Middleware;


use App\AuthProviders\ShopwareProvider;
use Closure;
use Illuminate\Http\Response;

class ShopwareAuth
{

    public function handle($request, Closure $next) {
        $authService = new ShopwareProvider($request->get('url'), $request->get('username'), $request->get('api_key'));
        $result = $authService->get($request->get('user_id'));
        if($result->status() !== Response::HTTP_OK){
            return response()->json(['content' => [], 'error_messages' => []], Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
