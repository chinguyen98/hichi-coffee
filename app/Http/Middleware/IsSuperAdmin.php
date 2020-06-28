<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsSuperAdmin
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
        if ($request->user('admin')) {
            if ($request->user('admin')->isSuperAdmin()) {
                return $next($request);
            }
            else{
                $request->session()->flash('flash_message', 'Chức Năng Chỉ Dành Cho Supper_Admin !!');
                return redirect('admins/home');
            }
        }
        
        return redirect('admins/login');
    }
}
