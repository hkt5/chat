<?php


namespace App\Http\Middleware;


use App\AuthProviders\ShopwareProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShopwareAuth
{

    public function handle(Request $request, Closure $next) {
        $header = $request->headers->get('X-AUTH');
        $user_data = json_decode(base64_decode($header), true);
        $authService = new ShopwareProvider($user_data['url'], $user_data['username'], $user_data['api_key']);
        $result = $authService->get($user_data['user_id']);
        if($result->status() !== Response::HTTP_OK){
            return response()->json(['content' => [], 'error_messages' => []], Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
