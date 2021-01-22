<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    protected $fillable = ['album_id', 'title', 'url', 'thumbnail_url'];
    public function albums() {
        return $this->belongsTo(Albums::class, 'album_id', 'id');
    }
}
