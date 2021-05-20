<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    public function getUser()
    {
        // ! Relación Many to one inversa
        // *Recupera el usuario con el campo user_id de la tabla comments
        return $this->belongsTo(User::class, 'user_id');
    }
    public function image()
    {
        // ! Relación Many to one inversa
        return $this->belongsTo(Image::class, 'image_id');
    }
}
