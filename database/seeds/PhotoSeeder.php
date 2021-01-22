<?php

use App\Photos;
use Illuminate\Database\Seeder;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $photos = json_decode(file_get_contents("photos.json"), true);
        foreach($photos as $value){
            $tableArray = [
                'album_id' => $value['album_id'],
                'title' => $value['title'],
                'url' => $value['url'],
                'thumbnail_url' => $value['thumbnail_url'],
            ];
            //create records in database
            Photos::create($tableArray);
        }
    }
}
