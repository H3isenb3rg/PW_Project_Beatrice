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
    public function goToCreate(Request $request, $id)
    {
        $dl = new DataLayer();
        $event = $dl->getEventByID($id);

        if (is_null($event)) {
            return Redirect::to(route("home"));
        }

        $current_view = view("bookEvent")->with("event", $event)
            ->with("loggedName", Session::get("loggedName"))
            ->with("isAdmin", $dl->isAdmin(Session::get("loggedName")));

        if (Session::has("alert")) {
            $current_view = $current_view->with("alert", Session::pull("alert"));
        }

        return $current_view;
    }

    public function store(Request $request)
    {
        $dl = new Datalayer();

        $table_name = $request->input("name");
        $guests = (int)$request->input("guests");
        $event = $request->input("event_id");
        $user = $dl->getUserID(Session::get("loggedName"));

        $event_obj = $dl->getEventByID($event);
        if (!is_null($event_obj)) {
            $total_seats = $event_obj->seats;
            $available_seats = $total_seats - $dl->countBooked($event);

            if ($total_seats > 0 && $available_seats < $guests) {
                Session::put("alert", __("labels.max_seats_reached", ["seats" => $total_seats]));
                return redirect()->route("reservation.goToCreate", ["id" => $event_obj->id]);
            }


            $dl->addReservation($table_name, $guests, $user, $event);
            Session::put("confirmReservation", __("labels.confirmReservation", [
                "guests" => $guests,
                "name" => ucwords($table_name),
                "event_name" => ucwords($event_obj->name),
                "date" => date_format(date_create($event_obj->event_date), 'd/m/Y')
            ]));
        }


        return Redirect::to(route("home"));
    }
}
