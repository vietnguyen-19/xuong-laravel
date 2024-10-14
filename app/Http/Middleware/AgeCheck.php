<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AgeCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $age =$request->input('age');

        if ($age && $age >= 18) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Bạn chưa đủ 18 tuổi để truy cập trang này.');
    }
}
