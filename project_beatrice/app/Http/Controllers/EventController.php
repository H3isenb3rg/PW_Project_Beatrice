<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{

    public function index()
    {
        return Redirect::route("home");
    }

    public function goToCurrentEvents()
    {
        $dl = new DataLayer();
        $events = $dl->fetchFutureEvents();

        $current_view = view("eventsList")->with("eventsList", $events);

        if (Session::has("logged")) {
            $current_view = $current_view->with("logged", Session::get("logged"))->with("loggedName", Session::get("loggedName"))->with("isAdmin", $dl->isAdmin(Session::get("loggedName")));
        } else {
            $current_view = $current_view->with("logged", false);
        }

        return $current_view;
    }

    public function goToCreate()
    {
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

    public function create(Request $request)
    {
        $dl = new DataLayer();
        $name = strtolower($request->input("name"));
        $description = $request->input("description");
        $date = $request->input("date");
        if (!$request->input("seats") == "") {
            $seats = (int)$request->input("seats");
        } else {
            $seats = "";
        }
        $venue = $request->input("venue_id");

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
        }
        if ($venue == "") {
            Session::put("alert", __('labels.missingField', ['field' => __('labels.venue')]));
            return Redirect::route("event.create");
        }

        // Insert in DB
        if ($dl->checkEventExists($name, $date)) {
            Session::put("alert", __('labels.eventAlreadyExists', ['name' => $name, "date" => $date]));
            return Redirect::route("event.create");
        }
        $dl->addEvent($name, $description, $date, $seats, $venue);

        $venue_name = $dl->getVenueName($venue);
        Session::put("confirm", __('labels.confirmNewEvent', ['name' => ucwords($name), "venue" => ucwords($venue_name), "date" => $date]));
        return Redirect::route("event.create");
    }
}
