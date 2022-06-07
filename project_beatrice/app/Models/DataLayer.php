<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AdjUser;
use App\Models\Reservation;
use Exception;

class DataLayer extends Model
{

    /**
     * 
     */
    public function listReservations($user)
    {
        $reservations = Reservation::where("user_id", $user)->get();
    }

    /**
     * Returns the list of all the venues in the database
     */
    public function listVenues() {
        return Venue::all();
    }

    /**
     * Checks if a user with the given username or email exists
     */
    public function checkUserExists($username, $email)
    {
        $users = AdjUser::where("username", $username)->orWhere->where("email", $email)->get();

        if (count($users) > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks if a venue with the given name already exists
     */
    public function checkVenueExists($name)
    {
        $venues = Venue::where("name", $name)->get();

        if (count($venues) > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Add a new venue to the DB.  
     */
    public function addVenue($name, $city, $address, $maps){
        $new_venue = new Venue();

        $new_venue->name = $name;
        $new_venue->city = $city;
        $new_venue->address = $address;
        if (!($maps=="")) {
            $new_venue->maps_link = $maps;
        }

        $new_venue->save();
    }

    /**
     * Add a new venue to the DB.  
     */
    public function addEvent($name, $description, $date, $seats, $venue_id){
        // TODO
    }

    /**
     * Add a new user to the DB.  
     */
    public function addUser($username, $password, $email)
    {
        $new_user = new AdjUser();

        $new_user->username = $username;
        $new_user->email = $email;
        $new_user->password = md5($password);
        $new_user->is_admin = false;

        $new_user->save();
    }

    public function validUser($username, $password)
    {
        // Ovviamente mi aspetto che questo array abbia al più un elemento
        // Specificando nella get i campi avrò solamente quei campi negli oggetti restituiti
        $users = AdjUser::where("username", $username)->get(["password",]);

        if (count($users) == 0) {
            return false;
        } else {
            return (md5($password) == $users[0]->password);
        }
    }

    public function isAdmin($username)
    {
        $user = AdjUser::where("username", $username)->get(["is_admin"])[0];

        if ($user->is_admin == "0") {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Gets the ID of the user with given username.  
     * 
     * The user must exist
     */
    public function getUserID($username)
    {
        $user = AdjUser::where("username", $username)->get(["id"])[0];

        return $user->id;
    }
}
