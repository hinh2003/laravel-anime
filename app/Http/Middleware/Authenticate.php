<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('sanctum')->check()) {
            return response()->json([
                'message' => 'Bạn chưa đăng nhập. Vui lòng đăng nhập để tiếp tục.'
            ], 401);
        }

        return $next($request);
    }
}
