<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserRedirection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

     public function handle(Request $request, Closure $next)
     {
         // Check if the user is authenticated
         $user = Auth::user();

         if ($user) {
             // Check if the user has the 'superadmin' role
             if (!$user->hasRole('superadmin')) {
                 // Check if the role has a page_redirect column value
                 $role = $user->roles->first(); // Assuming a user can have only one role
                 if ($role && $role->page_redirect && $role->page_redirect!= 'dashboard') {
                     return to_route($role->page_redirect);
                 }
             }
         }

         return $next($request);
     }
}
