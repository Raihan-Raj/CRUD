<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $check=Auth::user();
        if($check){
            if($check->typ==1 || $check->typ==2){
                return $next($request);
            }else{
                return redirect('/')->with('Success', 'Your Mission is Complete');
            }
        }else{
            return redirect('/');
        }
    }
}
