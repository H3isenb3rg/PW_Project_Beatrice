<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthCustom
{
    /**
     * Verifica che utente sia correttamente loggato
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {

        if(!Session::has("logged")) {
            Session::put("alert", "labels.notLogged");
            return Redirect::to(route("user.login"));
        }

        return $next($request);
    }
}
