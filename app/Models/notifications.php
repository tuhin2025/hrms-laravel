<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class notifications extends Model {
    protected $table = 'notifications';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable  = [
        'title',
        'message',
        'type',
        'user_id',
        'is_read',
        'insert_by',
        'insert_dt'

    ];


}
