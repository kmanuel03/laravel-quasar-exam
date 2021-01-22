<?php

use App\Albums;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $albums = json_decode(file_get_contents("albums.json"), true);
        foreach($albums as $value){
            $tableArray = [
                'user_id' => $value['user_id'],
                'title' => $value['title']
            ];
            //create records in database
            Albums::create($tableArray);
        }
    }
}
