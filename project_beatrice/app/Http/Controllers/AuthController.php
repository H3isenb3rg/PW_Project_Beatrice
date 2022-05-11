<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller {
    public function authentication() {
        return view("index")->with("logged", false);
    }

    public function logout() {
        return view("index")->with("logged", false);
    }
}
