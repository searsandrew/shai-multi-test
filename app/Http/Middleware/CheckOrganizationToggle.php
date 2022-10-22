<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class CheckOrganizationToggle
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
        $activeOrganizations = Auth::user()->activeOrganizations();

        if($activeOrganizations->count() != 1)
        {
            $activeOrganizations->update(['active' => false]);
            $firstOrganization = Auth::user()->organizations()->first();
            Auth::user()->organizations()->updateExistingPivot($firstOrganization->id, [
                'active' => true,
            ]);
        }

        return $next($request);
    }
}
