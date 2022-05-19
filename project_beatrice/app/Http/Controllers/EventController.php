<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{

    public function index() {
        return Redirect::route("home");
    }

    public function goToCreate() {
        return view('newEvent')->with("logged", Session::get("logged"))->with("loggedName", Session::get("loggedName"))->with("isAdmin", Session::get("is_admin"));
    }

    public function create() {
        // return view('book.editBookBootstrap')->with("logged", true)->with("loggedName", $_SESSION["loggedName"]);
        return Redirect::route("home");
    }
}
