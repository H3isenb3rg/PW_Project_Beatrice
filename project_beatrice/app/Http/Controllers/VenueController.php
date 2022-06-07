<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class VenueController extends Controller {
    
    public function index() {
        return Redirect::route("home");
    }

    public function create(Request $request) {
        $name = strtolower($request->input("name"));
        $city = strtolower($request->input("city"));
        $address = $request->input("address");
        $maps_link = $request->input("maps");

        // Insert in DB
        // TODO

        // Build Confirmation of insert
        $alert = __('labels.confirmNewVenue', ['name' => ucwords($name), "city" => ucwords($city)]);;
        Session::put("confirm", $alert);

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
