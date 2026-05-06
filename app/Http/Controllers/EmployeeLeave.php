<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\leavetype;

class EmployeeLeave extends Controller
{

    public function index()
    {
        $leaveTypes = leavetype::all();
//        dd($leaveTypes);
        return view('employee.leave', compact('leaveTypes'));
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

    public function leaveStore(Request $request)
    {
        DB::table('emp_leave_applications')->insert([
            'employee_id' => $request->employee_id,
            'leave_type' => $request->leave_type,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'total_days' => $request->total_days,
            'leave_reson' => $request->leave_reson,
            'status' => 'A'
        ]);

//       dd($request);
        return response()->json($request);

    }

    public function leaveData()
    {
        $data = DB::table('emp_leave_applications')
            ->join('employees', 'emp_leave_applications.employee_id', '=', 'employees.employee_id')
            ->join('jobs', 'employees.job_id', '=', 'jobs.job_id')
            ->join('departments', 'employees.department_id', '=', 'departments.department_id')
            ->join('l_leave_type', 'emp_leave_applications.leave_type', '=', 'l_leave_type.leave_type_id')
            ->select('employees.first_name',
                'employees.last_name',
                'departments.department_name',
                'jobs.job_title',
                'l_leave_type.leave_type_name',
                'emp_leave_applications.from_date',
                'emp_leave_applications.to_date',
                'emp_leave_applications.total_days'
            )
            ->orderBy('emp_leave_applications.app_id', 'DESC')
            ->get();
        return response()->json($data);

    }


}
