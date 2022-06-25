<?php

namespace Database\Seeders;

use App\Models\AdjUser;
use App\Models\DataLayer;
use App\Models\Event;
use App\Models\Venue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dl = new DataLayer();

        if (!$dl->checkUserExists("matteo", "matteo@mail.com")) {
            AdjUser::create([
                'username' => 'matteo',
                'email' => 'matteo@mail.com',
                'password' => md5('matteopass'),
                'is_admin' => true
            ]);
        }
        
        if (!$dl->checkUserExists("user", "user@mail.com")) {
            AdjUser::create([
                'username' => 'user',
                'email' => 'user@mail.it',
                'password' => md5('userpass'),
                "is_admin" => false
            ]);
        }

        $user1 = $dl->getUserID('matteo');
        $user2 = $dl->getUserID('user');

        /* 
        Author::factory()->count(10)->create(['user_id' => $user1])->each(function ($author) {
            Book::factory()->count(10)->create(['author_id' => $author->id, 'user_id' => $author->user_id]);
        });

        Author::factory()->count(10)->create(['user_id' => $user2])->each(function ($author) {
            Book::factory()->count(10)->create(['author_id' => $author->id, 'user_id' => $author->user_id]);
        }); 
        */
        $venue_total = 20;
        $event_total = 100;
        Venue::factory()->count($venue_total)->create();
        $venues_list = json_decode($dl->listVenues());

        for ($i = 0; $i < $event_total; $i++) {
            $venue = $venues_list[array_rand($venues_list)];
            try {
                Event::factory()->count(1)->create(['venue_id' => $venue->id]);
            } catch (\Illuminate\Database\QueryException $e) {
                continue;
            }
        }
    }
}
