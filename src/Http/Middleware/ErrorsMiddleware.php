<?php

namespace Tots\Core\Http\Middleware;

use Closure;

class ErrorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $response = $next($request);
        } catch (\Throwable $th) {
            return response()->json(['error' => [
                'message' => $th->getMessage(),
                'code' => $th->getCode(),
                'file' => $th->getFile(),
                'line' => $th->getLine()
            ]]);
        }

        return $response;
    }
}
