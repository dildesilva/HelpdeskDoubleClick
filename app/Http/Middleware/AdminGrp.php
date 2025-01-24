<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminGrp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        
        if ($request->user()->usertype==='admin') {
            return $next($request);

         }
         if ($request->user()->usertype==='user') {
             return redirect('/userDash');
         }
         if ($request->user()->usertype==='itEng') {
             return redirect('/engDash');
         }
         abort(401);
    }
}
// {{-- Copyright (c) 2025 Dilshan De Silva
//     This software and associated documentation files DoubleClick are the exclusive property of Dilshan De Silva. --}}