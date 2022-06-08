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
            $alert = Session::get("alert");
            Session::forget("alert");
            return $current_view->with("alert", __($alert));
        } else {
            return $current_view;
        }
    }
    
}
