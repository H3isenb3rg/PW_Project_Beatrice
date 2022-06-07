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

        $current_view = view('newEvent')->with("logged", Session::get("logged"))
                                        ->with("loggedName", Session::get("loggedName"))
                                        ->with("isAdmin", $dl->isAdmin(Session::get("loggedName")));
        

        if (Session::has("confirm")) {
            $current_view->with("confirm", Session::get("confirm"));
            Session::forget("confirm");
        }

        return $current_view;
    }

    public function create() {
        // return view('book.editBookBootstrap')->with("logged", true)->with("loggedName", $_SESSION["loggedName"]);
        return Redirect::route("home");
    }
}
