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
     *
     * @return array
     */
    public function listVenues()
    {
        return Venue::all();
    }

    /**
     * Checks if a user with the given username OR email exists
     *
     * @param string $username The username of the user to find
     * @param string $email The email of the user to find
     * @return boolean
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
     *
     * @param string $name The name of the venue to find
     * @return boolean
     */
    public function checkVenueExists($name)
    {
        $venue = Venue::where("name", $name)->first();

        if (is_null($venue)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Checks if an event with the same name on the same day is already in DB
     *
     * @param string $name
     * @param string $date
     * @return boolean
     */
    public function checkEventExists(string $name, string $date) {
        $event = Event::where("name", $name)->where("event_date", $date)->first();

        if (is_null($event)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Add a new venue to the DB.   
     *
     * @param string $name The name of the new venue
     * @param string $city The city of the new venue
     * @param string $address The address of the new venue
     * @param string $maps The link to the google maps position ("" no link was given)
     * @return void
     */
    public function addVenue(string $name, string $city, string $address, string $maps)
    {
        $new_venue = new Venue();

        $new_venue->name = $name;
        $new_venue->city = $city;
        $new_venue->address = $address;
        if (!($maps == "")) {
            $new_venue->maps_link = $maps;
        }

        $new_venue->save();
    }

    /**
     * Add a new event to the DB.
     *
     * @param string $name
     * @param string $description
     * @param string $date
     * @param string $seats
     * @param string $venue_id
     * @return void
     */
    public function addEvent($name, $description, $date, $seats, $venue_id)
    {
        $new_event = new Event();

        $new_event->name = $name;
        $new_event->description = $description;
        $new_event->event_date = $date;
        $new_event->venue_id = $venue_id;
        if (!$seats=="") {
            $new_event->seats = $seats;
        }
        
        $new_event->save();        
    }

    /**
     * Add a new user to the DB.
     *
     * @param string $username The username of the new user
     * @param string $password The plain password of the new user
     * @param string $email The email of the new user
     * @return void
     */
    public function addUser(string $username, string $password, string $email)
    {
        $new_user = new AdjUser();

        $new_user->username = $username;
        $new_user->email = $email;
        $new_user->password = md5($password);
        $new_user->is_admin = false;

        $new_user->save();
    }

    /**
     * Checks if a user with the given username exists and if the given password is correct
     *
     * @param string $username The username to find
     * @param string $password The plain password sent by the user
     * @return boolean
     */
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

    /**
     * Checks if the user with given username is an Admin
     *
     * @param string $username The username of the user to check
     * @return boolean
     */
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
     * The user must exist
     *
     * @param string $username
     * @return string
     */
    public function getUserID($username)
    {
        $user = AdjUser::where("username", $username)->get(["id"])[0];

        return $user->id;
    }

    /**
     * Gets the name of the venue with the given ID
     *
     * @param string $id
     * @return string
     */
    public function getVenueName($id) {
        $venue = Venue::where("id", $id)->first();

        return $venue->name;
    }
}
