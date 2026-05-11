<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CleanNullValues
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $data = $request->all();

        foreach ($data as $key => $value) {
            if (is_array($value) && count($value) === 1 && $value[0] === null) {
                $request->request->remove($key);
            }
        }

        return $next($request);
    }
}
