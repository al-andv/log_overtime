<?php

namespace App\Http\Middleware;

use Closure;

class CheckTimeMiddleware
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
        if (!isset($_COOKIE['start'])) {
            setcookie('start', time());
            setcookie('end', 'stop', time() + 600);
        } elseif (!isset($_COOKIE['end'])) {
            setcookie('start', "", -1, '/AL_training/logtime/admin');
            return redirect('page/logout');
        }
        session_start();
        setcookie('end', 'stop', time() + 600, '/AL_training/logtime/admin');
        return $next($request);
    }
}
