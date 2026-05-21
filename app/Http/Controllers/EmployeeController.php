<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Employee;
use Yajra\DataTables\Facades\DataTables;


use App\Models\job;

//Use App\Models\Regions;
use Illuminate\Support\Facades\DB;


class EmployeeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
//        $employees = \App\Models\Employee::with('department')->get();
        $employees = Employee::with('department', 'job')
            ->paginate(5);
        $job = job::all();
        $departments = Department::all();

        return view('employee.employee', compact('employees', 'departments', 'job'));

    }




    public function empStore(Request $request)
    {
        try {

            $request->validate(
                [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|email',
                    'emp_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                ],
                [
                    'first_name.required' => 'First name Required',
                    'last_name.required' => 'Last name Required',
                    'email.required' => 'Email Required',
                    'email.email' => 'Valid email Required (example@gmail.com)',
                    'emp_image.image' => 'File must be an image',
                    'emp_image.mimes' => 'Only jpg, jpeg, png formats allowed',
                    'emp_image.max' => 'Image size must be less than 2MB',
                ]
            );

            $base64Image = null;
            if ($request->hasFile('emp_image')) {
                $image = $request->file('emp_image');
                $base64Image = base64_encode(file_get_contents($image->getRealPath()));
            }

            Employee::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'hire_date' => $request->hire_date,
                'job_id' => $request->job_id,
                'salary' => $request->salary,
                'manager_id' => $request->manager_id,
                'department_id' => $request->department_id,
                'active_status' => $request->active_status,
                'emp_image' => $base64Image
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
        $employee = Employee::findOrFail($id);
        $employees = Employee::with('department', 'job')
            ->paginate(5);
        $departments = Department::all();
       // $employees = Employee::all();
        $job = job::all();
        return view('employee.employee', compact('employee', 'departments', 'employees', 'job'));
    }

    public function empUpdate(Request $request, $id)
    {
        $request->validate(
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
            ],
            [
                'first_name.required' => 'First name Required',
                'last_name.required' => 'Last name Required',
                'email.required' => 'Email Required',
                'email.email' => 'Valid email Required (example@gmail.com)',
            ]
        );
        $employee = Employee::findOrFail($id);

        // default old image
        $base64Image = $employee->emp_image;

        // new image override
        if ($request->hasFile('emp_image')) {
            $image = $request->file('emp_image');
            $base64Image = base64_encode(file_get_contents($image->getRealPath()));
        }
        $employee->Update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'hire_date' => $request->hire_date,
            'job_id' => $request->job_id,
            'salary' => $request->salary,
            'manager_id' => $request->manager_id,
            'department_id' => $request->department_id,
            'active_status' => $request->active_status,
            'emp_image' => $base64Image
        ]);
        return redirect()
            ->route('employee.index')
            ->with('success', 'Employee Updated Successfully');
    }

    public function empDelete($id)
    {
//        dd('fghj');
        Employee::find($id)->delete();
        return redirect()->back()->with('success', 'Deleted');
    }
}
