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

    public function edit(Request $request) {
        $dl = new DataLayer();
        $curr_venue = $dl->getVenueByID($request->input("venueID"));
        $new_name = $request->input("name");
        $new_city = $request->input("city");
        $new_address = $request->input("address");
        $new_maps = $request->input("maps");

        $has_changed = false;
        if ($curr_venue->name != $new_name) {
            $curr_venue->name = $new_name;
            $has_changed = true;
        }

        if ($curr_venue->city != $new_city) {
            $curr_venue->city = $new_city;
            $has_changed = true;
        }

        if ($curr_venue->address != $new_address) {
            $curr_venue->address = $new_address;
            $has_changed = true;
        }

        if (isset($new_maps)) {
            if (isset($curr_venue->maps_link)) {
                if ($curr_venue->maps_link != $new_maps) {
                    $curr_venue->maps_link = $new_maps;
                    $has_changed = true;
                }
            } else {
                $curr_venue->maps_link = $new_maps;
                $has_changed = true;
            }
        }
        
        if ($has_changed) {
            $curr_venue->save();
            Session::put("confirm", __("Venue successfully modified"));
        }

        return Redirect::route("event.create");
    }

    public function ajaxNewVenue(Request $request) {
        $dl = new DataLayer();
        $name = $request->input("name");
        $city = $request->input("city");

        return response()->json(["found" => $dl->checkVenueExists($name, $city)]);
    }

    public function ajaxEditVenue(Request $request) {
        $dl = new DataLayer();
        $id = $request->input("id");
        $name = $request->input("name");
        $city = $request->input("city");
        $curr_venue =  $dl->getVenueByID($id);
        $found = false;

        if(strtolower($name) != strtolower($curr_venue->name) || strtolower($city) != strtolower($curr_venue->city)) {
            $found = $dl->checkVenueExists($name, $city);
        }

        return response()->json(["found" => $found]);
    }

    public function ajaxGetVenue(Request $request) {
        $dl = new DataLayer();

        $venue = $dl->getVenueByID($request->input("venueID"));

        $data = [
            "id" => $venue->id,
            "name" => $venue->name,
            "address" => $venue->address,
            "city" => $venue->city,
        ];

        if (isset($venue->maps_link)) {
            $data["maps"] = $venue->maps_link;
        } else {
            $data["maps"] = "";
        }

        return response()->json($data);
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
