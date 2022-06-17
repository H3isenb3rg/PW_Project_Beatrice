<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model {
    use HasFactory;
    
    protected $table = "event";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'event_date', 'seats', 'venue_id'];

    public function reservations() {
        return $this->hasMany("App\Models\Reservation");
    }

    public function venue() {
        return $this->belongsTo("App\Models\Venue");
    }
}
