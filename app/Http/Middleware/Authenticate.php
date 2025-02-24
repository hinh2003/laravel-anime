<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()) {
            return response()->json([
                'message' => 'Bạn chưa đăng nhập. Vui lòng đăng nhập để tiếp tục.'
            ], 401);
        }

        return $next($request);
    }
}
