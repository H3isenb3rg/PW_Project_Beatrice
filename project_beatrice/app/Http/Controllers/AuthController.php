<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller {
    public function authentication() {
        $alert = "";

        if (Session::has("error")) {
            $alert = $this->create_alert(Session::get("error"));
            Session::flush();
        }

        return view("auth.auth")->with("alert", $alert);
    }

    public function logout() {
        Session::flush();

        return Redirect::to(route("home"));
    }

    public function login(Request $request) {
        $dl = new DataLayer();

        $username = $request->input("username");
        $pwd = $request->input("password");

        if ($dl->validUser($username, $pwd)) {
            Session::put("logged", true);
            Session::put("loggedName", $username);
            Session::put("is_admin", $dl->isAdmin($username));

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

    /**
     * Creates the Bootstrap alert with a custom message
     */
    private function create_alert($message) {
        return '<div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button> ' .
                        $message
                    .'</div>';
    }
}
