<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model {
    use HasFactory;

    protected $table = "venue";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'city', 'address', 'maps_link'];

    public function events() {
        return $this->hasMany("App\Models\Event");
    }
}
