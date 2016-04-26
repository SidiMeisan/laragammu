<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Illuminate\Session\Store;
use App\Http\Controllers\Sentinel\AuthController;

class WebAuth
{
    public function __construct(AuthController $sent) {
        $this->sent = $sent;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if(!Sentinel::check()) {
            return redirect($this->sent->redirectTo)->with('errorMessage', 'Tidak ada Akses');
        }
        return $next($request);
    }
}
