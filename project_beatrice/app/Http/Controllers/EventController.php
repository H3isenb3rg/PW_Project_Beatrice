<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EventController extends Controller {
    
    public function index() {
        return Redirect::route("home");
    }

    public function create() {
        session_start();
        if(!isset($_SESSION["logged"])) {
            return Redirect::to(route("user.login"));
        }

        // return view('book.editBookBootstrap')->with("logged", true)->with("loggedName", $_SESSION["loggedName"]);
        return Redirect::route("home");
    }
}
