<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ReservationController extends Controller
{

    public function store(Request $request)
    {
        $dl = new Datalayer();

        $table_name = $request->input("table_name");
        $guests = (int)$request->input("guests");
        $event = $request->input("event_id");
        $user = $dl->getUserID(Session::get("loggedName"));

        $event_obj = $dl->getEventByID($event);
        if (!is_null($event_obj)) {
            if ($dl->usedResName($event_obj->id, $table_name)) {
                Session::put("alert", __("Table Name already in use"));
                return redirect()->back();
            }

            $total_seats = $event_obj->seats;
            $available_seats = $total_seats - $dl->countBooked($event);

            if ($total_seats > 0 && $available_seats < $guests) {
                Session::put("alert", __("labels.max_seats_reached", ["seats" => $total_seats]));
                return redirect()->back();
            }


            $dl->addReservation($table_name, $guests, $user, $event);
            Session::put("confirm", __("labels.confirmReservation", [
                "guests" => $guests,
                "name" => ucwords($table_name),
                "event_name" => ucwords($event_obj->name),
                "date" => date_format(date_create($event_obj->event_date), 'd/m/Y')
            ]));
        }

        return Redirect::to(route('event.goToDetails', ['id' => $event]));
    }

    public function index() {
        $dl = new DataLayer();
        $user_id = $dl->getUserID(Session::get("loggedName"));

        $userReservations = $dl->fetchFutureReservations($user_id);

        $current_view = view("reservationsList", [
            "reservationsList" => $userReservations,
            "loggedName" => Session::get("loggedName"),
            "isAdmin" => $dl->isAdmin(Session::get("loggedName")),
            "lang" => Session::get("language")
        ]);
        
        if(Session::has("alert")) {
            $current_view = $current_view->with("alert", Session::pull("alert"));
        }
        if(Session::has("confirm")) {
            $current_view = $current_view->with("confirm", Session::pull("confirm"));
        }

        return $current_view;
    }

    public function edit(Request $request, $reservation) {
        $dl = new DataLayer();
        $table_name = $request->input("table_name");
        $guests = (int)$request->input("guests");

        $dl->updateReservation($reservation, $table_name, $guests);

        return Redirect::route("reservation.index");
    }

    public function ajaxUpdateReservationCount(Request $request) {
        $dl = new DataLayer();
        $event_id = $request->input("event_id");

        $response = array("guests" => $dl->countBooked($event_id));
        $response["reservations"] = $dl->countReservations($event_id);
        return response()->json($response);
    }

    public function ajaxEditReservation(Request $request) {
        $dl = new DataLayer();
        $table_name = $request->input("table_name");
        $guests = $request->input("guests");
        $id = $request->input("reservation_id");

        $curr_reservation = $dl->getReservationByID($id);
        $event = $curr_reservation->event;
        $available_seats = $event->seats - $dl->countBooked($event->id);

        $validGuests = -1;
        if ($guests>$curr_reservation->guests) {
            if ($available_seats < $guests-$curr_reservation->guests) {
                $validGuests = $available_seats;
            }
        } 

        $validName= true;
        if (strtolower($table_name) != strtolower($curr_reservation->name)) {
            $validName = !($dl->usedResName($event->id, $table_name));
        }

        $response = [
            "validGuests" => $validGuests,
            "validName" => $validName,
            "eventName" => $event->seats
        ];

        return response()->json($response);
    }

    public function delete(Request $request, $id) {
        $dl = new DataLayer();

        $dl->deleteResByID($id);

        Session::put("confirm", __("Reservation successfully deleted"));

        return redirect()->back();
    }
}
