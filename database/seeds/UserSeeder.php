<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = json_decode(file_get_contents("users.json"), true);
        foreach($users as $value){
            $tableArray = [
                'name' => $value['name'],
                'username' => $value['username'],
                'email' => $value['email'],
                'phone' => $value['phone'],
                'website' => $value['website'],
            ];
            //create records in database
            User::create($tableArray);

        }
    }
}
