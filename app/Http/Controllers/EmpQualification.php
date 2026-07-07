<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\EmpQualificationMaster;
use App\Models\EmpQualificationDetail;

class EmpQualification extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $loginUser = Auth::user();
        $employees = Employee::all();

        return view('employee.qualification', compact('loginUser', 'employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'level' => 'required|array|min:1',
        ]);

        DB::beginTransaction();

        try {

            $master = new EmpQualificationMaster();

            $master->employee_id = $request->employee_id;
            $master->remarks = $request->remarks;
            $master->insert_by = Auth::id();
            $master->insert_dt = now();
            $master->status = 'A';

            $master->save();
//            dd($request->level);
            foreach ($request->level as $key => $level) {

                $detail = new EmpQualificationDetail();

                $detail->mst_id = $master->mst_id;
                $detail->education_level = $level;
                $detail->group_subject = $request->subject[$key];
                $detail->institute_name = $request->institute[$key];
                $detail->passing_year = $request->year[$key];
                $detail->result_value = $request->result[$key];
                $detail->board_university = $request->board[$key];
                $detail->created_by = Auth::id();
                $detail->created_at = now();

                $detail->save();
            }

            DB::commit();

            return redirect()->back()->with('success', 'Employee Qualification Saved Successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
