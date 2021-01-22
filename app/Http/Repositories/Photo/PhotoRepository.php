<?php


namespace App\Http\Repositories\Photo;


use App\Albums;
use App\Http\Resources\Photo as PhotoResource;
use App\Photos;

class PhotoRepository implements PhotoInterface
{
    /**
     * @var Albums
     */
    private $album;
    /**
     * @var Photos
     */
    private $photo;

    public function __construct(Albums $albums, Photos $photos)
    {
        $this->album = $albums;
        $this->photo = $photos;
    }
    public function findPhotoById($id)
    {
        $photo = $this->photo->find($id);

        return new PhotoResource($photo);
    }


    public function getPhotosByAlbum($album_id)
    {
       $photos = $this->photo->where('album_id', $album_id)->with('albums')->orderBy('id', 'desc')->get();

       return PhotoResource::collection($photos);
    }

}
