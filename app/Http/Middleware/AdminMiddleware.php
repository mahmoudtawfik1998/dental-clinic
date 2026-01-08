<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // التحقق من تسجيل الدخول
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'يجب تسجيل الدخول أولاً');
        }

        // التحقق من أن المستخدم admin
        if (Auth::user()->role !== 'admin') {
            Auth::logout();
            return redirect()->route('login')
                ->with('error', 'ليس لديك صلاحية الدخول لهذه الصفحة');
        }

        return $next($request);
    }
}