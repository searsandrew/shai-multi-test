<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckForDonorId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(is_null($request->session()->get('donor')))
        {
            return redirect(route('donor.signup.form'));
        }

        return $next($request);
    }
}