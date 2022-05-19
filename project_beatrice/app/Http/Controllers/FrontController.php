<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller {

    public function getHome() {
        $dl = new DataLayer();

        if(Session::has("logged")) {
            return view('index')->with("logged", true)
                                ->with("loggedName", Session::get("loggedName"))
                                ->with("isAdmin", $dl->isAdmin(Session::get("loggedName")));
        } else {
            return view('index')->with("logged", false); 
        }
    }
    
}
