<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{

    public function index()
    {
        return Redirect::route("home");
    }

    public function goToCreate()
    {
        if (Session::has("logged")) {
            return view('newEvent')->with("logged", true)->with("loggedName", Session::get("loggedName"))->with("isAdmin", Session::get("is_admin"));
        } else {
            return view('newEvent')->with("logged", false);
        }
    }

    public function create()
    {
        session_start();
        if (!isset($_SESSION["logged"])) {
            return Redirect::to(route("user.login"));
        }

        // return view('book.editBookBootstrap')->with("logged", true)->with("loggedName", $_SESSION["loggedName"]);
        return Redirect::route("home");
    }
}
