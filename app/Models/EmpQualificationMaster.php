<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpQualificationMaster extends Model
{
    protected $table = 'emp_qualification_master';

    protected $primaryKey = 'mst_id';

    public $timestamps = false;

    protected $fillable = [
        'employee_id',
        'remarks',
        'insert_by',
        'insert_dt',
        'updated_by',
        'updated_dt',
        'status',
    ];

    public function details()
    {
        return $this->hasMany(EmpQualificationDetail::class, 'mst_id', 'mst_id');
    }
}
