<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model {
    protected $table = "event";
    public $timestamps = false;

    public function reservations() {
        return $this->hasMany("App\Models\Reservation");
    }

    public function venue() {
        return $this->belongsTo("App\Models\Venue");
    }
}
