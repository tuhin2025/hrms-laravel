<?php

namespace App\Http\Controllers;

use app\models\job;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
//use App\Models\Department;
//use App\Models\Employee;

use Illuminate\Support\Facades\DB;

class OraclehrController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function index()
    {
        $departmentCount = \App\Models\Department::count();
        $employeeCount = \App\Models\Employee::count();
        $jobCount = \App\Models\job::count();

        return view('hr.dashboard', compact('departmentCount', 'employeeCount','jobCount'));
    }

    public function deptList()
    {
        $departments = \App\Models\Department::with('location')->get();
        $locations = DB::table('locations')->get();

        return view('dept.dept', compact('departments', 'locations'));
    }


    public function deptStore(Request $request)
    {
        \App\Models\Department::create([
            'department_name' => $request->department_name,
            'manager_id' => $request-> manager_id,
            'location_id'=> $request-> location_id
        ]);

        return redirect()->back()->with('success', 'Department Added');
    }

    public function deptEdit($id)
    {
        $department = \App\Models\Department::findOrFail($id);
        $departments = \App\Models\Department::with('location')->get();
        $locations = DB::table('locations')->get();

        return view('dept.dept', compact('department', 'departments', 'locations'));
    }

    public function deptUpdate(Request $request, $id)
    {
        $dept = \App\Models\Department::findOrFail($id);

        $dept->update([
            'department_name' => $request->department_name,
            'location_id'     => $request->location_id, // ✅ ADD THIS
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


