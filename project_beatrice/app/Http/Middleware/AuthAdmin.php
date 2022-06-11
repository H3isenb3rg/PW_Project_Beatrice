<?php

namespace App\Http\Middleware;

use App\Models\DataLayer;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthAdmin
{
    /**
     * Verifica che utente sia correttamente admin
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {
        $dl = new DataLayer();

        if(!$dl->isAdmin(Session::get("loggedName"))) {
            Session::put("alert", "labels.notAdmin");
            return Redirect::to(route("home"));
        }

        return $next($request);
    }
}
