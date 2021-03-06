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

        if (Session::has("alert")) {
            $current_view->with("alert", __(Session::pull("alert")));
        }

        if (Session::has("inRegistration")) {
            Session::forget("inRegistration");
            $current_view->with("inRegistration", true);
        }

        return $current_view->with("lang", Session::get("language"));
    }

    public function logout() {
        Session::flush();

        return Redirect::to(route("home"));
    }

    public function login(Request $request) {
        // To avoid double authentication after ajax auth
        if (Session::has("logged") && Session::get("logged")) {
            if (Session::has("fromPage")) {
                return Redirect::to(Session::pull("fromPage"));
            } else {
                return Redirect::to(route("home"));
            }
        }

        $dl = new DataLayer();

        $username = $request->input("username");
        $pwd = $request->input("password");

        if ($dl->validUser($username, $pwd)) {
            Session::put("logged", true);
            Session::put("loggedName", $username);

            if (Session::has("fromPage")) {
                return Redirect::to(Session::pull("fromPage"));
            }

            // Torniamo alla vista index
            return Redirect::to(route("home"));
        } else {
            Session::put("alert", "labels.wrongAuth");
            return Redirect::to(route("user.login"));
        }
    }

    public function registration(Request $request) {
        $dl = new DataLayer();
        $username = $request->input("username");
        $email = $request->input("email");

        if ($dl->checkUserExists($username, $email)) {
            Session::put("alert", "labels.userAlreadyPresent");
            Session::put("inRegistration", true);
        } else {
            $dl->addUser($username, $request->input("password"), $email);
        }

        return Redirect::to(route("user.login"));
    }

    public function ajaxLogin(Request $request) {
        $dl = new Datalayer();
        $username = $request->input("username");
        $password = $request->input("password");

        $response = array("valid" => $dl->validUser($username, $password));

        if ($response["valid"]) {
            Session::put("logged", true);
            Session::put("loggedName", $username);
        }

        return response()->json($response);
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
