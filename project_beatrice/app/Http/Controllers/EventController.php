<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
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
                                        ->with("isAdmin", $dl->isAdmin(Session::get("loggedName")))
                                        ->with("venueList", $dl->listVenues());
        

        if (Session::has("confirm")) {
            $current_view->with("confirm", Session::get("confirm"));
            Session::forget("confirm");
        }

        if (Session::has("alert")) {
            $current_view->with("alert", Session::get("alert"));
            Session::forget("alert");
        }

        return $current_view;
    }

    public function create() {
        return Redirect::route("home");
    }
}
