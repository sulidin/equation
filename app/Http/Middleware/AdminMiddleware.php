<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
      public function handle(Request $request, Closure $next)
        {
            // Check if the user is authenticated and has the admin role
          if (auth()->user() && auth()->user()->is_admin) {
            return $next($request);
        }

            // Redirect to login page if user is not an admin
            return redirect()->route('login');
        }

}
