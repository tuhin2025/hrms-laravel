<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    public $timestamps = false;
    protected $primaryKey = 'employee_id';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'hire_date',
        'job_id',
        'salary',
        'department_id',
        'manager_id'
    ];


    public function department()
    {
        return $this->belongsTo(\App\Models\Department::class, 'department_id', 'department_id');
    }


    public function job()
    {
        return $this->belongsTo(\App\Models\Job::class, 'job_id', 'job_id');
    }


    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id', 'employee_id');
    }


    public function subordinates()
    {
        return $this->hasMany(Employee::class, 'manager_id', 'employee_id');
    }

    // Accessor (Full Name)
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
