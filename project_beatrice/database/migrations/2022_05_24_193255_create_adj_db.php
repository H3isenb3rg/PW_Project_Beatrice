<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("role");
            $table->string("image");
        });
        
        Schema::create('gallery', function (Blueprint $table) {
            $table->id();
            $table->string("path");
            $table->boolean("is_home");
        });
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string("username");
            $table->string("email")->unique();
            $table->string("password");
            $table->boolean("is_admin");
        });

        Schema::create('venue', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("city");
            $table->string("address");
            $table->string("maps_link")->nullable();
        });

        Schema::create('event', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->multiLineString("description");
            $table->dateTime("date");
            $table->integer("seats")->nullable();
            $table->foreignId("venue_id");
        });

        Schema::create('reservation', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("guests");
            $table->foreignId("user_id");
            $table->foreignId("event_id");
        });

        Schema::table("event", function (Blueprint $table) {
            $table->foreign("venue_id")->references("id")->on("venue");
        });

        Schema::table("reservation", function (Blueprint $table) {
            $table->foreign("event_id")->references("id")->on("event");
            $table->foreign("user_id")->references("id")->on("user");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation');
        Schema::dropIfExists('event');
        Schema::dropIfExists('venue');
        Schema::dropIfExists('user');
        Schema::dropIfExists('team');
        Schema::dropIfExists('gallery');
    }
};
