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
        $name = strtolower($request->input("name"));
        $city = strtolower($request->input("city"));
        $address = $request->input("address");

        $maps_link = trim($request->input("maps"));
        if (filter_var($maps_link, FILTER_VALIDATE_URL) === FALSE) {
            // Per semplicità rendo nullo il link
            $maps_link = "";
        }

        // Insert in DB
        if ($dl->checkVenueExists($name)) {
            Session::put("alert", __('labels.venueAlreadyExists', ['name' => ucwords($name)]));
            return Redirect::route("event.create");
        }
        $dl->addVenue($name, $city, $address, $maps_link);

        
        Session::put("confirm", __('labels.confirmNewVenue', ['name' => ucwords($name), "city" => ucwords($city)]));
        return Redirect::route("event.create");
        
    }

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
