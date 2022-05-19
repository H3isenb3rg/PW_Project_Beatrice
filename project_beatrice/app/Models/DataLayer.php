<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AdjUser;
use App\Models\Reservation;
use Exception;

class DataLayer extends Model {
    
    public function listReservations($user) {
        $reservations = Reservation::where("user_id", $user)->get();
    }

    public function addUser($username, $password, $email) {
        $new_user = new AdjUser();
        
        $new_user->username = $username;
        $new_user->email = $email;
        $new_user->pwd = md5($password);
        $new_user->is_admin = false;

        $new_user->save();
    }

    public function validUser($username, $password) {
        // Ovviamente mi aspetto che questo array abbia al più un elemento
        // Specificando nella get i campi avrò solamente quei campi negli oggetti restituiti
        $users = AdjUser::where("username", $username)->get(["pwd", ]);

        if(count($users) == 0) {
            return false;
        } else {
            return (md5($password) == $users[0]->pwd);
        }
    }

    public function isAdmin($username) {
        $user = AdjUser::where("username", $username)->get(["is_admin"])[0];

        if ($user->is_admin == "0") {
            return false;
        } else {
            return true;
        }
    }
}
