<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckBlockedState
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
        if (!Auth::user()) {
            $request->session()->flash('message', 'Please login.');
            return redirect()->to('login');
        }

        if (! Auth::user()->isActive()) {
            $request->session()->flash('message', 'You have no permission. You are blocked. Please login again.');
            return redirect()->to('login');
        }
        return $next($request);
    }
}
