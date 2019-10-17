<?php


namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\DB;
class DBTransaction
{
    public function handle($request, Closure $next)
    {
        DB::beginTransaction();
        $response = $next($request);
        DB::commit();
        return $response;
    }
}
