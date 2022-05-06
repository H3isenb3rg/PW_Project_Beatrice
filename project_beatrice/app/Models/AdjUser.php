<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdjUser extends Model {
    protected $table = "user";

    public function reservations() {
        return $this->hasMany("App\Models\Reservation");
    }
}
