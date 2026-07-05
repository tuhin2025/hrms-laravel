<?php

namespace App\Http\Controllers;

use App\Models\notifications;
use App\Models\Users;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OraclehrController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function index()
    {
        $departmentCount = \App\Models\Department::count();
        $employeeCount = \App\Models\Employee::count();
        $jobCount = \App\Models\job::count();


        return view('hr.dashboard', compact('departmentCount', 'employeeCount', 'jobCount'));
    }


    public function deptList()
    {
        $departments = \App\Models\Department::with('location')->get();
        $locations = DB::table('locations')->get();

        return view('dept.dept', compact('departments', 'locations'));
    }


    public function deptStore(Request $request)
    {

        DB::beginTransaction();
        try {
            \App\Models\Department::create([
                'department_name' => $request->department_name,
                'manager_id' => $request->manager_id,
                'location_id' => $request->location_id
            ]);

            $users = Users::all();
            $loginUser = Auth::user();
            foreach ($users as $user) {
                notifications::create([
                    'title' => 'New Dept Created',
                    'message' => 'A New Department "' . $request->department_name . '" has been created.',
                    'type' => 'Dept',
                    'is_read' => '0',
                    'user_id' => $user->user_id,
                    'insert_by' => $loginUser->user_id,
                    'insert_dt' => now()

                ]);
            }
            DB::commit();
            return redirect()->back()->with('success', 'Department Added');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong: ' . $e->getMessage());
        }
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
            'location_id' => $request->location_id, // ✅ ADD THIS
        ]);

        return redirect()->route('hr.dept-list')->with('success', 'Updated');
    }

    public function deptDelete($id)
    {
        \App\Models\Department::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Deleted');
    }


    public function jobTypeData()
    {
        $data = DB::table('employees as e')
            ->join('jobs_hr as j', 'e.job_id', '=', 'j.job_id')
            ->select('j.job_title as job_type', DB::raw('count(*) as total'))
            ->groupBy('j.job_title')
            ->get();

        return response()->json($data);
    }
}

;


