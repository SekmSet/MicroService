<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = [
        'message',
        'created_at',
        'updated_at'
    ];

    public function sender(){
        return $this->hasMany(User::class, 'id', 'id_userS');
    }

    public function receiver(){
        return $this->hasMany(User::class, 'id', 'id_userR');
    }
}