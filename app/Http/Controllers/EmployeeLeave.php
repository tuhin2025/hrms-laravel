<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeLeave extends Controller
{

    public function index()
    {

        return view('employee.leave');
    }

    public function searchEmp(Request $request)
    {
        $employees = DB::table('employees')
            ->join('departments', 'employees.department_id', '=', 'departments.department_id')
            ->join('jobs', 'employees.job_id', '=', 'jobs.job_id')
            ->select('employees.employee_id',
                'employees.first_name',
                'employees.last_name',
                'employees.job_id',
                'jobs.job_title',
                'employees.department_id',
                'departments.department_name')
            ->orderBy('employees.employee_id', 'ASC')
            ->get();
        return response()->json($employees);


    }


}
