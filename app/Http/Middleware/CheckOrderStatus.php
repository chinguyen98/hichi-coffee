<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class CheckOrderStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $status)
    {
        $id_order = $request->route()->parameter('id');
        $current_status = DB::table('order_statuses')->where('id_order', $id_order)->where('is_current', 1)->first(['id_status'])->id_status;

        if($status == $current_status){
            return $next($request);
        }
        
        return redirect()->route('admins.home');
    }
}
