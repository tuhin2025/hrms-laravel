<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class EmpQualificationDetail extends model
{
    protected $table = 'emp_qualification_detail';
    protected $primaryKey = 'dtl_id';
    public $timestamps = 'false';
    protected $fillable = [
        'mst_id',
        'education_level',
        'degree_name',
        'group_subject',
        'institute_name',
        'board_university',
        'passing_year',
        'result_type',
        'result_value',
        'duration',
        'is_current',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',

    ];
}
