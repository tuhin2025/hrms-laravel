<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class job extends Model
{

    protected $table = 'jobs_hr';
//    protected $primaryKey = 'job_id';
    public $timestamps = false;
    protected $fillable = [
        'job_id',
        'job_title',
        'min_salary',
        'max_salary'

    ];

    protected $casts = [
        'job_id' => 'string',
    ];
}
