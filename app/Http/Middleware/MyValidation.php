<?php

namespace App\Http\Middleware;
use App\Http\Controllers\Controller;
use App\Validation;
use Closure;

class MyValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $validator = app('App\Http\Controllers\Controller');
        if ($request->isMethod('post'))
        dd($request->id);
        {
        $validator->validate($request, Validation::rules($request), [], Validation::fieldsAttributes());
        }

        return $next($request);
    }
}
