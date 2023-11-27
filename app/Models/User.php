<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'username', 'email', 'password',
    ];

    public function userDetails()
    {
        return $this->hasOne(UserDetails::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
