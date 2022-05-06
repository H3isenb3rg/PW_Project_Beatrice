<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AdjUser;
use App\Models\Reservation;

class DataLayer extends Model {
    
    public function listReservations($user) {
        $reservations = Reservation::where("user_id", $user)->get();
    }
}
