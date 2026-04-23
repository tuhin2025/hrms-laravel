<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Department;

class OraclehrController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function index()
    {
//        return view('hr.dashboard', [
//            'employeeCount' => Employee::count(),
//            'departmentCount' => Department::count(),
//            'jobCount' => Job::count(),
//            'employees' => Employee::with('department')->latest()->limit(5)->get()
//        ]);
        return view('hr.dashboard');
    }


    public function deptList()
    {
        $departments = \App\Models\Department::all();
        return view('dept.dept', compact('departments'));
    }

    public function deptStore(Request $request)
    {
        \App\Models\Department::create([
            'department_name' => $request->department_name,
            'manager_id' => $request-> manager_id
        ]);

        return redirect()->back()->with('success', 'Department Added');
    }

    public function deptEdit($id)
    {
        $department = \App\Models\Department::findOrFail($id);
        return view('dept.dept', compact('department'));
    }


    public function deptUpdate(Request $request, $id)
    {
        $dept = \App\Models\Department::findOrFail($id);

        $dept->update([
            'department_name' => $request->department_name
        ]);

        return redirect()->route('hr.dept-list')->with('success', 'Updated');
    }

    public function deptDelete($id)
    {
        \App\Models\Department::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Deleted');
    }
}

;


