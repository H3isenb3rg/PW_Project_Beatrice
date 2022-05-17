<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller {

    public function getHome() {
        session_start();

        if(Session::has("logged")) {
            return view('index')->with("logged", true)->with("loggedName", Session::get("loggedName"))->with("isAdmin", Session::get("is_admin"));
        } else {
            return view('index')->with("logged", false); 
        }
    }
    
}
