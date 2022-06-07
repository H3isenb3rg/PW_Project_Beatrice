<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Translation\Translator;

class AuthController extends Controller {
    public function authentication() {
        $current_view = view("auth.auth");

        if (Session::has("error")) {
            $alert = Session::get("error");
            Session::forget("error");
            $current_view->with("alert", __($alert));
        }

        if (Session::has("inRegistration")) {
            Session::forget("inRegistration");
            $current_view->with("inRegistration", true);
        }

        return $current_view;
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

            // Torniamo alla vista index
            return Redirect::to(route("home"));
        } else {
            Session::put("error", "labels.wrongAuth");
            return Redirect::to(route("user.login"));
        }
    }

    public function registration(Request $request) {
        $dl = new DataLayer();
        $username = $request->input("username");
        $email = $request->input("email");

        if ($dl->checkUserExists($username, $email)) {
            Session::put("error", "labels.userAlreadyPresent");
            Session::put("inRegistration", true);
        } else {
            $dl->addUser($username, $request->input("password"), $email);
        }

        return Redirect::to(route("user.login"));
    }

    /**
     * @deprecated
     * Creates the Bootstrap alert with a custom message
     */
    private function create_alert($message) {
        return '<div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button> ' .
                        $message
                    .'</div>';
    }
}
