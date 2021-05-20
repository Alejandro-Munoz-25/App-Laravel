<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    public function comments()
    {
        // ! Relación One to Many
        return $this->hasMany(Comment::class)->orderBy('id', 'DESC');
    }
    public function likes()
    {
        // ! Relación One to Many
        return $this->hasMany(Like::class);
    }
    public function user()
    {
        // ! Relación Many to one inversa
        return $this->belongsTo(User::class, 'user_id');

        // return $this->belongsTo('App\Models\User', 'user_id');
    }
}
