<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Albums extends Model
{
    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function photos() {
        return $this->hasMany(Photos::class, 'album_id', 'id');
    }
}
