<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeacherAdminAccess
{

    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->type == 'admin' || auth()->user()->type == 'teacher'){
            return $next($request);
        }
        return response()->view('errors.check-permission');
    }
}
