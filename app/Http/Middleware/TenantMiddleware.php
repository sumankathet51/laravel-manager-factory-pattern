<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $domain = $request->getHost();
        $tenant = Tenant::where('domain', $domain)->with(['settings'])->first();

        app()->instance('tenant', $tenant);
        if($tenant->settings)
        {
            $settings = $tenant->settings->pluck('value', 'key');
            app()->instance('settings', $settings);
        }

        return $next($request);
    }
}
