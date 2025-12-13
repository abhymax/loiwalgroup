<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class InventoryAuth
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
        if ($request->session()->get('inventory_admin_id') == '') {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                Session::flush();
                return redirect('/inventorylogin');
            }
        }
        return $next($request);
    }
}
