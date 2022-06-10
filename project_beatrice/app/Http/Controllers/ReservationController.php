<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReservationController extends Controller
{
    /**
     * Gets the page to create a new reservation
     * 
     * User is logged
     *
     * @return view
     */
    public function goToCreate(Request $request, $id) {
        $dl = new DataLayer();

        return view("bookEvent")->with("event_id", $id)
                                ->with("loggedName", Session::get("loggedName"))
                                ->with("isAdmin", $dl->isAdmin(Session::get("loggedName")));
    }
}
