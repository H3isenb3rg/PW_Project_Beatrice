<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class VenueController extends Controller {
    
    public function index() {
        return Redirect::route("home");
    }

    public function create(Request $request) {
        $dl = new DataLayer();
        $name = $request->input("name");
        $city = strtolower($request->input("city"));
        $address = $request->input("address");

        $redirect_create = Redirect::route("event.create");

        $maps_link = trim($request->input("maps"));
        if (filter_var($maps_link, FILTER_VALIDATE_URL) === FALSE) {
            Session::put("alert", __("Bad formatted location url"));
            return $redirect_create;
        }

        if ($name == "") {
            Session::put("alert", __("Missing required Venue name"));
            return $redirect_create;
        }

        if ($city == "") {
            Session::put("alert", __("Missing required field Venue city"));
            return $redirect_create;
        }

        if ($address == "") {
            Session::put("alert", __("Missing required field Venue address"));
            return $redirect_create;
        }

        // Insert in DB
        if ($dl->checkVenueExists($name, $city)) {
            Session::put("alert", __('labels.venueAlreadyExists', ['name' => $name, "city" => ucwords($city)]));
            return $redirect_create;
        }
        $dl->addVenue($name, $city, $address, $maps_link);

        Session::put("confirm", __('labels.confirmNewVenue', ['name' => $name, "city" => ucwords($city)]));
        return $redirect_create;
    }

    public function ajaxNewVenue(Request $request) {
        $dl = new DataLayer();
        $name = $request->input("name");
        $city = $request->input("city");

        return response()->json(["found" => $dl->checkVenueExists($name, $city)]);
    }

    /**
     * Old build alert function
     *
     * @deprecated
     */
    private function build_confirm_alert($name, $city, $address, $maps_link) {
        return '<div class="alert alert-success alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button> 
                        <p>' . $name . '</p>
                        <p>' . $city . '</p>
                        <p>' . $address . '</p>
                        <p>' . $maps_link . '</p></div>';
    }
}
