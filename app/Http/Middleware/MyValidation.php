<?php

namespace App\Http\Middleware;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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

        return $next($request);
    }

    protected function rules()
    {

    }

    protected function fieldsAttributes()
    {

    }
}
