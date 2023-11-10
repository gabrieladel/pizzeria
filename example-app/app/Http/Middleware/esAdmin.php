<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class esAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /* $user=Auth::user();
	
		if (Auth::check()){
			
        	if (!$user->esAdmin()){
            	
			return redirect('/');
			
			}
				
		} */
        
            if (Auth::user()->role == "admin") {
              return $next($request);
            } else {
              return redirect("/home")->withMyerror("You are not authorized for this action");
            }
         
		
        return $next($request);
    }
}
