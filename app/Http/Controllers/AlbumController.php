<?php

namespace App\Http\Controllers;

use App\Albums;
use App\Http\Repositories\Photo\PhotoInterface;
use App\Http\Requests\PhotoRequest;
use App\Http\Resources\Album as AlbumResource;
use App\Http\Resources\Photo as PhotoResource;
use App\Photos;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation;

class AlbumController extends Controller
{
    /**
     * @var Albums
     */
    private $album;
    /**
     * @var Photos
     */
    private $photo;
    /**
     * @var PhotoInterface
     */
    private $iPhoto;

    public function __construct(Albums $albums, Photos $photos, PhotoInterface $iPhoto)
    {
        $this->album = $albums;
        $this->photo = $photos;
        $this->iPhoto = $iPhoto;
    }
    public function list() {
        $albums = $this->album->with('users')->get();

        return AlbumResource::collection($albums);
    }

    public function getPhotos($id) {
        $albums = $this->iPhoto->getPhotosByAlbum($id);

        return PhotoResource::collection($albums);
    }

    public function store(PhotoRequest $request) {
        $photo = $this->photo->create($request->all());

        return new PhotoResource($photo->fresh());
    }

    public function edit($id, PhotoRequest $request) {
        $photo = tap($this->iPhoto->findPhotoById($id))->update($request->all());

        return new PhotoResource($photo);
    }

    public function delete($id, Request $request) {
        $photo = $this->photo->find($id)->delete();

        $photos = $this->iPhoto->getPhotosByAlbum($request->album_id);

        return response()->json(['data' => $photos]);
    }

    public function details($id) {
       return $this->iPhoto->findPhotoById($id);
    }
}
