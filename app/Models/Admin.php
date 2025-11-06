<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = "admins";

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'status'
    ];

    protected $hidden = [
        'password',
    ];
}
