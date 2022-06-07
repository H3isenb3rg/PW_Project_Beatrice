<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model {
    protected $table = "venue";
    public $timestamps = false;

    public function events() {
        return $this->hasMany("App\Models\Event");
    }
}
