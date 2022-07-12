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

        //$this->random_events($dl);
        $this->real_events($dl);
    }

    private function random_events($dl)
    {
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


    private function real_events($dl)
    {
        $asdGiravolta = Venue::create(["name"=>"ASD Giravolta Studio Danze", "city"=>"Volta Mantovana MN", "address"=>"Via Friuli, 46049 Volta Mantovana MN", "maps_link"=>"https://g.page/ASD-giravolta-studio-danze?share"]);
        Event::create(["name" => "ASD Giravolta", "description" => "SAB 24 SETTEMBRE- ASD GIRAVOLTA - Volta Mantovana MN", "event_date" => "2022-09-24", "venue_id" => $asdGiravolta->id]);
        Event::create(["name" => "ASD Giravolta", "description" => "SAB 22 OTTOBRE- ASD GIRAVOLTA - Volta Mantovana MN", "event_date" => "2022-10-22", "venue_id" => $asdGiravolta->id]);
        Event::create(["name" => "ASD Giravolta", "description" => "SAB 19 NOVEMBRE ASD GIRAVOLTA - Volta Mantovana MN", "event_date" => "2022-11-19", "venue_id" => $asdGiravolta->id]);
        Event::create(["name" => "ASD Giravolta", "description" => "SAB 10 DICEMBRE- ASD GIRAVOLTA - Volta Mantovana MN", "event_date" => "2022-12-10", "venue_id" => $asdGiravolta->id]);
        Event::create(["name" => "ASD Giravolta", "description" => "DOM 25 DICEMBRE- ASD GIRAVOLTA - Volta Mantovana MN", "event_date" => "2022-12-25", "venue_id" => $asdGiravolta->id]);
        
        $avalon = Venue::create(["name"=>"Avalon", "city"=>"Asola MN", "address"=>"Via Toscana, 29, 46041 Asola MN", "maps_link"=>"https://goo.gl/maps/KH4x4Hs4jcVDZW3dA"]);
        Event::create(["name" => "Dancing Avalon", "description" => "SAB 17  SETTEMBRE - DANCING AVALON - Asola MN", "event_date" => "2022-09-17", "venue_id" => $avalon->id]);
        Event::create(["name" => "Dancing Avalon", "description" => "SAB 29  OTTOBRE - DANCING AVALON - Asola MN", "event_date" => "2022-10-29", "venue_id" => $avalon->id]);
        Event::create(["name" => "Dancing Avalon", "description" => "SAB 03  DICEMBRE - DANCING AVALON - Asola MN", "event_date" => "2022-12-03", "venue_id" => $avalon->id]);
        Event::create(["name" => "Dancing Avalon", "description" => "SAB 31 DICEMBRE - DANCING AVALON - Asola MN", "event_date" => "2022-12-31", "venue_id" => $avalon->id]);
        Event::create(["name" => "Dancing Avalon", "description" => "DOM 01 GENNAIO- DANCING AVALON - Asola MN", "event_date" => "2023-01-01", "venue_id" => $avalon->id]);

        $fontanellaCG = Venue::create(["name"=>"Parco la Fontanella", "city"=>"Castel Goffredo MN", "address"=>"via 46042, Via Italia, 17, Castel Goffredo MN", "maps_link"=>"https://goo.gl/maps/33riyQL9wnBUsf2W6"]);
        Event::create(["name" => "Festa AVIS in Fontanella", "description" => "SAB 27 AGOSTO - FESTA AVIS in Fontanella  - Castel Goffredo MN", "event_date" => "2022-08-27", "venue_id" => $fontanellaCG->id]);

        $acquanegra = Venue::create(["name"=>"Acquanegra Sul Chiese", "city"=>"Acquanegra Sul Chiese MN", "address"=>"21/A Piazza Garibaldi, Acquanegra Sul Chiese, MN 46011", "maps_link"=>"https://goo.gl/maps/sk2exnw2qigo7PBf7"]);
        Event::create(["name" => "Festa", "description" => "MER  17  AGOSTO - FESTA  - ACQUANEGRA S/C  MN", "event_date" => "2022-08-17", "venue_id" => $acquanegra->id]);

        $isorella = Venue::create(["name"=>"Isorella", "city"=>"Isorella BS", "address"=>"Piazza Roma, 4, 25010 Isorella BS", "maps_link"=>"https://goo.gl/maps/oGtsYcmB7CSxXkwt5"]);
        Event::create(["name" => "Sagra di San Rocco", "description" => "DOM  14  AGOSTO - Sagra di San Rocco  - Isorella BS", "event_date" => "2022-08-14", "venue_id" => $isorella->id]);

        $giravolta = Venue::create(["name"=>"Foresto Volta Mantovana", "city"=>"Volta Mantovana MN", "address"=>"Foresto 46049 Mantova", "maps_link"=>"https://goo.gl/maps/59jun1x5mXdevDNX7"]);
        Event::create(["name" => "Giravolta Esatate", "description" => "SAB 06 AGOSTO -Giravolta Estate- Foresto - Volta Mantovana (MN)", "event_date" => "2022-08-06", "venue_id" => $giravolta->id]);

        $acquafredda = Venue::create(["name"=>"Campo Sportivo 'Prestini'", "city"=>"Acquafredda BS", "address"=>"Viale Cimitero, 25010 Acquafredda BS", "maps_link"=>"https://goo.gl/maps/XiDLpnMJGv87TiWz5"]);
        Event::create(["name" => "Festa Simpatia", "description" => "SAB 30 LUGLIO - Festa Simpatia  - Acquafredda (BS)", "event_date" => "2022-07-30", "venue_id" => $acquafredda->id]);

        $poiano = Venue::create(["name" => "Poiano", "city" => "Castel Goffredo MN", "address" => "SP6, 31-27, 46042 Castel Goffredo MN", "maps_link" => "https://goo.gl/maps/77wpbUxtfQwZpV4N9"]);
        Event::create(["name" => "Sagra del Poiano", "description" => "EVENTO dell'ANNO a Castel Goffredo (MN) SAGRA DEL POIANO 23-24 LUGLIO 2022 TEAM ARCANGELO", "event_date" => "2022-07-23", "venue_id" => $poiano->id]);
        Event::create(["name" => "Sagra del Poiano", "description" => "EVENTO dell'ANNO a Castel Goffredo (MN) SAGRA DEL POIANO 23-24 LUGLIO 2022 TEAM ARCANGELO", "event_date" => "2022-07-24", "venue_id" => $poiano->id]);

        $mosio = Venue::create(['name' => "Mosio", 'city' => "Mosio di Acquanegra", 'address' => "Via Trieste, 854, 46011 Mosio MN", 'maps_link' => "https://goo.gl/maps/ZD7nBLV8ahmw9vKAA"]);
        Event::create(['name' => "Mosio in Festa", 'description' => "Domenica 17 Luglio.. MOSIO in Festa e si BALLA !!!", 'event_date' => "2022-07-17", 'venue_id' => $mosio->id]);

        $solaroloR = Venue::create(["name" => "Solarolo Rainerio", "city" => "Solarolo Rainerio CR", "address" => "Via Giuseppina, 83, 26030 Solarolo Rainerio CR", "maps_link" => "https://goo.gl/maps/bhAj5Lmn4whE3VXM9"]);
        Event::create(["name" => "Festa Hawaiana", "description" => "Aloha! 22 Luglio Solarolo Rainerio !!! Vamos Amigos!", "event_date" => "2022-07-22", "venue_id" => $solaroloR->id]);
    }
}
