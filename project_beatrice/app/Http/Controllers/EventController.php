<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{

    public function index() {
        return Redirect::route("home");
    }

    public function goToCreate() {
        $dl = new DataLayer();
        return view('newEvent') ->with("logged", Session::get("logged"))
                                ->with("loggedName", Session::get("loggedName"))
                                ->with("isAdmin", $dl->isAdmin(Session::get("loggedName")));
    }

    public function create() {
        // return view('book.editBookBootstrap')->with("logged", true)->with("loggedName", $_SESSION["loggedName"]);
        return Redirect::route("home");
    }
}
