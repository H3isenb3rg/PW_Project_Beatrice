<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller {

    public function getHome() {
        $dl = new DataLayer();

        // Sets initial home view
        if(Session::has("logged")) {
            $current_view =  view('index')->with("logged", true)
                                ->with("loggedName", Session::get("loggedName"))
                                ->with("isAdmin", $dl->isAdmin(Session::get("loggedName")));
        } else {
            $current_view =  view('index')->with("logged", false); 
        }
        
        // If present translates and adds the alert message
        if (Session::has("alert")) {
            $current_view = $current_view->with("alert", __(Session::pull("alert")));
        }

        // If present translates and adds the reservation confirm message
        if (Session::has("confirmReservation")) {
            $current_view = $current_view->with("confirm", Session::pull("confirmReservation"));
        }

        // Retrieve upcoming events
        $upcoming_events = $dl->fetchFutureEvents(4);

        return $current_view->with("eventsList", $upcoming_events);
    }
    
}
