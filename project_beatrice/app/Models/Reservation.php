<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model {
    protected $table = "reservation";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'guests', 'user_id', 'event_id'];

    public function user() {
        return $this->belongsTo("App\Models\AdjUser");
    }

    public function event() {
        return $this->belongsTo("App\Models\Event");
    }
}
