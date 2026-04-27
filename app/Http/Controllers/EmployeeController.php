<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Employee;

use App\Models\job;

//Use App\Models\Regions;
use Illuminate\Support\Facades\DB;


class EmployeeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $employees = \App\Models\Employee::with('department' ) ->get();
        $job = job::all();
        $departments = Department::all();

        return view('employee.employee', compact('employees', 'departments', 'job'));

    }


    public function empStore(Request $request)
    {
        try {

            Employee::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'hire_date' => $request->hire_date,
                'job_id' => $request->job_id,
                'salary' => $request->salary,
                'manager_id' => $request->manager_id,
                'department_id' => $request->department_id
            ]);

            return redirect()->back()->with('success', 'Employee Added Successfully');

        } catch (Exception $e) {

            return redirect()->back()
                ->with('error', 'Something went wrong!')
                ->withInput();

        }
    }

    public function empEdit($id)
    {
        $employee = \App\Models\Employee::with('department')->find($id);
        $departments = Department::all();
        $employees = Employee::all();

        return view('employee.employee', compact('employee', 'departments', 'employees'));
    }

    public function empUpdate(Request $request, $id)
    {


    }
}
