<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{
    public function edit(Request $request)
    {
        $dl = new DataLayer();
        $id = $request->input("event_id");
        if (!$dl->checkEventID($id)) {
            Session::put("alert", __("Error while updating event"));
            return Redirect::to(route("home"));
        }

        $venue_id = $request->input("venue_id");
        $seats = $request->input("seats");
        $date = $request->input("date");
        $desc = $request->input("description");
        $name = $request->input("name");

        // Fields Checks
        $curr_redirect = Redirect::to(route("event.goToDetails", ["id" => $id]));
        if ($name == "") {
            Session::put("alert", __('labels.missingField', ['field' => __('labels.name')]));
            return $curr_redirect;
        }

        if ($desc == "") {
            Session::put("alert", __('labels.missingField', ['field' => __('labels.description')]));
            return $curr_redirect;
        }

        if ($date == "") {
            Session::put("alert", __('labels.missingField', ['field' => __('labels.date')]));
            return $curr_redirect;
        } else {
            $date = Carbon::parse($date)->format("Y-m-d");
            $today = date("Y-m-d");
            if ($date < $today) {
                Session::put("alert", __("New Event date can't be before today"));
                return $curr_redirect;
            }
        }

        if ($venue_id == "") {
            Session::put("alert", __('labels.missingField', ['field' => __('labels.venue')]));
            return $curr_redirect;
        } else if (!$dl->checkVenueID($venue_id)) {
            Session::put("alert", __("Error while updating event"));
            return Redirect::to(route("home"));
        }

        if ($dl->checkEventExists($date)) {
            if ($dl->getEventByNameDate($name, $date)->id != $id) {
                Session::put("alert", __("labels.eventAlreadyExists", ["date" => $date]));
                return $curr_redirect;
            }
        }

        $booked_seats = $dl->countBooked($id);
        if ($seats == "") {
            $seats = 0;
        } else if ($seats > 0 && $booked_seats > (int)$seats) {
            Session::put("alert", __("There are already :seats guests booked. Can't lower total seats to :new_seats", ["seats" => $booked_seats, "new_seats" => $seats]));
            return $curr_redirect;
        }

        $dl->update_event(
            $id,
            $name,
            $desc,
            $date,
            $seats,
            $venue_id
        );

        Session::put("confirm", __("Successfully updated the Event"));
        return $curr_redirect;
    }

    public function goToDetails(Request $request, $id)
    {
        $dl = new DataLayer();
        $venueList = $dl->listVenues();
        $event = $dl->getEventByID($id);
        $event->setAttribute("available_seats", $event->seats - $dl->countBooked($id));
        $isAdmin = $dl->isAdmin(Session::get("loggedName"));

        $current_view = view("eventPage")->with("event", $event)
            ->with("loggedName", Session::get("loggedName"))
            ->with("isAdmin", $isAdmin)
            ->with("venueList", $venueList);
        
        if (!$isAdmin) {
            $reservation = $dl->getUserReservationForEvent($event->id, Session::get("loggedName"));
            if (count($reservation)>0) {
                $current_view = $current_view->with("reservation", $reservation[0])->with("lang", Session::get("language"));
            }
        } else {
            $current_view = $current_view->with("lang", Session::get("language"));
        }

        if (Session::has("alert")) {
            $current_view = $current_view->with("alert", Session::pull("alert"));
        }
        if (Session::has("confirm")) {
            $current_view = $current_view->with("confirm", Session::pull("confirm"));
        }

        return $current_view;
    }

    public function goToCurrentEvents()
    {
        $dl = new DataLayer();
        $events = $dl->fetchFutureEvents(11);
        $total = $events->count();
        $venueList = $dl->listVenues();
        $lastLoadedDate = $events[$total - 1]->event_date;
        if ($total > 10) {
            $events->pop();
        }

        $current_view = view("eventsList", [
            "eventsList" => $events,
            "venueList" => $venueList,
            "last_loaded_date" => $lastLoadedDate
        ]);

        if (Session::has("logged")) {
            $current_view = $current_view->with("logged", Session::get("logged"))->with("loggedName", Session::get("loggedName"))->with("isAdmin", $dl->isAdmin(Session::get("loggedName")));
        } else {
            $current_view = $current_view->with("logged", false)->with("isAdmin", false);
        }

        return $current_view;
    }

    public function ajaxFetchNextEvents(Request $request)
    {
        $lastLoadedDate = $request->input("lastLoadedDate");
        $venue_filter = $request->input("venue_filter");


        $dl = new DataLayer();
        $future_events = $dl->fetchFutureEvents(5, $lastLoadedDate, $venue_filter);
        $total = $future_events->count();
        $response = array();
        if ($total<=0) {
            $response["count"] = 0;
            return response()->json($response);
        }

        $response["lastLoadedDate"] = $future_events[$total - 1]->event_date;
        $response["count"] = $total;

        // Build wells
        $isAdmin = false;
        if (Session::has("loggedName")) {
            $isAdmin = $dl->isAdmin(Session::get("loggedName"));
        }

        $wells = array();
        foreach ($future_events as $event) {
            $wells[] = $this->build_well($event, $isAdmin);
        }

        $response["wells"] = $wells;
        return response()->json($response);
    }

    private function build_well($event, $isAdmin)
    {   
        return view('components.event.well')->with("event", $event)->with("isAdmin", $isAdmin)->render();
    }

    /**
     * Gets the create event page
     * 
     * Accessible only by admins
     *
     * @return void
     */
    public function goToCreate()
    {
        $dl = new DataLayer();

        $current_view = view('newEvent')->with("lang", Session::get("language"))->with("loggedName", Session::get("loggedName"))->with("venueList", $dl->listVenues());


        if (Session::has("confirm")) {
            $current_view->with("confirm", Session::pull("confirm"));
        }

        if (Session::has("alert")) {
            $current_view->with("alert", Session::pull("alert"));
        }

        return $current_view;
    }

    public function create(Request $request)
    {
        $dl = new DataLayer();
        $name = $request->input("name");
        $description = $request->input("description");
        $date = $request->input("date");
        if (!$request->input("seats") == "") {
            $seats = (int)$request->input("seats");
        } else {
            $seats = "";
        }
        $venue = $request->input("venue_id");
        if (!$dl->checkVenueID($venue)) {
            Session::put("alert", __("Error while creating event"));
            return Redirect::route("home");
        }

        // Check validity of fieds
        if ($name == "") {
            Session::put("alert", __('labels.missingField', ['field' => __('labels.name')]));
            return Redirect::route("event.create");
        }
        if ($description == "") {
            Session::put("alert", __('labels.missingField', ['field' => __('labels.description')]));
            return Redirect::route("event.create");
        }
        if ($date == "") {
            Session::put("alert", __('labels.missingField', ['field' => __('labels.date')]));
            return Redirect::route("event.create");
        } else {
            $date = Carbon::parse($date)->format("Y-m-d");
            $today = date("Y-m-d");
            if ($date < $today) {
                Session::put("alert", __("New Event date can't be before today"));
                return Redirect::route("event.create");
            }
        }
        if ($venue == "") {
            Session::put("alert", __('labels.missingField', ['field' => __('labels.venue')]));
            return Redirect::route("event.create");
        }

        // Insert in DB
        if ($dl->checkEventExists($date)) {
            Session::put("alert", __('labels.eventAlreadyExists', ['name' => $name, "date" => $date]));
            return Redirect::route("event.create");
        }
        $dl->addEvent($name, $description, $date, $seats, $venue);

        $venue_name = $dl->getVenueName($venue);
        Session::put("confirm", __('labels.confirmNewEvent', ['name' => $name, "venue" => $venue_name, "date" => $date]));
        return Redirect::route("event.create");
    }

    public function destroy(Request $request, $id) {
        $dl = new DataLayer();

        if ($dl->eventHasReservations($id)) {
            $dl->deleteEventReservations($id);
        }
        $dl->deleteEvent($id);

        Session::put("confirm", __("Successfully deleted the event"));

        return Redirect::route("home");
    }

    public function ajaxNewEvent(Request $request)
    {
        $dl = new DataLayer();

        if (is_null($dl->getVenueByID($request->input("venue")))) {
            $response = array("venue_valid" => false);
        } else {
            $response = array("venue_valid" => true);
        }

        if ($dl->checkEventExists($request->input("event_date"))) {
            $response["unique"] = false;
        } else {
            $response["unique"] = true;
        }

        return response()->json($response);
    }
}
