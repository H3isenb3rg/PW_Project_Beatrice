<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller {
    public function authentication() {
        return view("auth.auth");
    }

    public function logout() {
        session_start();
        session_destroy();

        return Redirect::to(route("home"));
    }

    public function login(Request $request) {
        session_start();
        $dl = new DataLayer();

        $username = $request->input("username");
        $pwd = $request->input("password");

        if ($dl->validUser($username, $pwd)) {
            $_SESSION['logged'] = true;
            $_SESSION['loggedName'] = $username;
            $_SESSION["is_admin"] = $dl->isAdmin($username);

            // Torniamo alla vista index
            return Redirect::to(route("home"));
        } else {
            return "ERROR";
        }
    }

    public function registration(Request $request) {
        $dl = new DataLayer();

        $dl->addUser($request->input("username"), $request->input("password"), $request->input("email"));

        return Redirect::to(route("user.login"));
    }
}
