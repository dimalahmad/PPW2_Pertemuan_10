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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and has the 'admin' level
        if (auth()->check() && auth()->user()->level === 'admin') {
            return $next($request); // Allow access
        }

        // Redirect non-admin users to the home page with an error message
        return redirect('buku')->with('error', 'Access Denied: Admins Only');
    }
}
