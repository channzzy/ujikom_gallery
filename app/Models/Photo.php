<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = [
        'album_photo_id',
        'user_id',
        'path',
        'title',
        'description',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function albums(){
        return $this->hasMany(AlbumPhoto::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
