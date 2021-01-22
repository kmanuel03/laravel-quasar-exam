<?php


namespace App\Http\Repositories\Photo;


interface PhotoInterface
{
    public function findPhotoById($id);
    public function getPhotosByAlbum($album_id);

}
