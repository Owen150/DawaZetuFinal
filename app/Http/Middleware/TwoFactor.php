<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactor
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
        $user = Auth::user();

        if (Auth::check() && $user->two_factor_code) {

            $twofactorDate = Carbon::createFromFormat('Y-m-d H:i:s', $user->two_factor_expires_at);

            if ($twofactorDate->lt(now())) {

               $user->resetTwoFactorCode();

               Auth::logout();

               return redirect('/login')->with('unsuccess', 'Two factor code has expired please login again');

               
            }
            

            if (!$request->is('verify*')) {
                return redirect()->route('two_factor');
            }
        }
        return $next($request);
    }
}
