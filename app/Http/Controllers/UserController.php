<?php

namespace App\Http\Controllers;

use App\Albums;
use App\Http\Resources\Album as AlbumResource;
use App\User;
use Illuminate\Http\Request;
use \App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var Albums
     */
    private $album;

    public function __construct(User $user, Albums $albums)
    {
        $this->user = $user;
        $this->album = $albums;
    }

    public function list() {
        $users = $this->user->all();

        return UserResource::collection($users);
    }

    public function listAlbums($id) {

        $albums =  $this->album->where('user_id', $id)->get();
        return AlbumResource::collection($albums);
    }
}
