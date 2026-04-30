<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    protected $table = 'users';

    protected $primaryKey = 'user_id';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'email',
        'password',
        'active_status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

    protected $hidden = [
        'password',
    ];
}
