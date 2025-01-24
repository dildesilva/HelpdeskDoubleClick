<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserGrp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // atnotication chose
         if ($request->user()->usertype==='admin') {
            return redirect('/dashboard');

         }
         if ($request->user()->usertype==='user') {
            return $next($request);

         }
         if ($request->user()->usertype==='itEng') {
             return redirect('/engDash');
         }
         abort(401);
    }
}
