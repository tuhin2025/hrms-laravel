<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Location;

class Department extends Model
{
    protected $table = 'departments';

    protected $primaryKey = 'department_id';

    public $timestamps = false; // because Oracle HR table has no created_at/updated_at

    protected $fillable = [
        'department_name',
        'manager_id',
        'location_id'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'location_id');
    }
}
