<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckBuyer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $notification = array(
            'message' => 'Only buyers are allowed to perform this action',
            'alert-type' => 'error'
        );
        if(auth()->user()->type == 'Buyer'){
            return $next($request);
        }
        else{
            return redirect()->back()->with($notification);
        }
    }
}
