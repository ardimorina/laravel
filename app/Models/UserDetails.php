<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    protected $fillable = [
        'user_id', 'additional_info_field_1', 'additional_info_field_2',
        // Add other additional fields as needed
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
