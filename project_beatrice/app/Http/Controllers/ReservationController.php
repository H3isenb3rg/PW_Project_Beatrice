<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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
        $event = $dl->getEventByID($id);

        if (is_null($event)) {
            return Redirect::to(route("home"));
        }

        return view("bookEvent")->with("event", $event)
                                ->with("loggedName", Session::get("loggedName"))
                                ->with("isAdmin", $dl->isAdmin(Session::get("loggedName")));
    }
}
