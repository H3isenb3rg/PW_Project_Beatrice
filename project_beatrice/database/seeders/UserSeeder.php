<?php

namespace Database\Seeders;

use App\Models\AdjUser;
use App\Models\DataLayer;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database user seeds.
     *
     * @return void
     */
    public function run()
    {
        $dl = new DataLayer();

        AdjUser::create($this->new_user("matteo", True));
        $user1 = $dl->getUserID("matteo");
        
        AdjUser::create($this->new_user("user", False));
        $user2 = $dl->getUserID("user");
    }

    /**
     * Builds the array of the new user
     * 
     * @param   string  $username   The username of the new user
     * @param   boolean $admin      Specifies if the user is an admin  
     * 
     * @return  array   Data of the new user ready to be created
     */
    private function new_user(string $username, bool $admin) {
        return [
            "username" => $username,
            "email" => $username . "@mail.com",
            "password" => md5($username . "pass"),
            "is_admin" => $admin
        ];
    }
}
