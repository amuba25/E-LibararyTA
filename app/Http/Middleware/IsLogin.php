<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsLogin
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
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->is_active == 'nonaktif') {
                return redirect()->route('login')->with('msg', ['type' => 'danger', 'message' => 'Silahkan Login Terlebih Dahulu!']);
            }
            return $next($request);
        }
        return redirect()->route('login')->with('msg', ['type' => 'danger', 'message' => 'Silahkan Login Terlebih Dahulu!']);
    }
}
