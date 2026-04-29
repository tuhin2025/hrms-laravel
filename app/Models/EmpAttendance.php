<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpAttendance extends Model
{
    protected $table = 'emp_attendance';
    protected $primaryKey = 'attendance_id';
    public $timestamps = false;
    protected $fillable = [
        'employee_id',
        'attendance_date',
        'shift_id',
        'check_in',
        'check_out',
        'status',
        'working_hours',
        'remarks',
        'created_by',
        'updated_by',

    ];


    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    public function shift()
    {
        return $this->belongsTo(Shifts::class, 'shift_id', 'shift_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'user_id');
    }

}
