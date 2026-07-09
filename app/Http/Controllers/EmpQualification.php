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
        $employees = Employee::whereNotIn('employee_id', function ($query) {
            $query->select('employee_id')
                ->from('emp_qualification_master');
        })->get();
        $qualifications = DB::table('employees as e')
            ->join('emp_qualification_master as q', 'e.employee_id', '=', 'q.employee_id')
            ->join('departments as d', 'e.department_id', '=', 'd.department_id')
            ->join('jobs_hr as j', 'e.job_id', '=', 'j.job_id')
            ->selectRaw("q.mst_id,
            CONCAT(e.first_name, ' ', e.last_name) AS emp_name,
            e.hire_date,
            d.department_name,
            j.job_title,
            e.employee_id
        ")
            ->paginate(5);

//         dd($qualifications);

        return view('employee.qualification', compact('loginUser', 'employees', 'qualifications'));
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

    public function edit($id)
    {
        $masterData = EmpQualificationMaster::findOrFail($id);
        $details = EmpQualificationDetail::where('mst_id', $id)->get();
        $employees = Employee::all();

        return view('employee.qualification', compact('masterData', 'details', 'employees'));

    }

    public function view($id)
    {
        $masterData = EmpQualificationMaster::findOrFail($id);
        $details = EmpQualificationDetail::where('mst_id', $id)->get();
        $employees = Employee::all();
        $viewMode = true;
        return view('employee.qualification', compact('masterData', 'details', 'employees', 'viewMode'));

    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            // Update Master
            $master = EmpQualificationMaster::findOrFail($id);

            $master->employee_id = $request->employee_id;
            $master->remarks = $request->remarks;
            $master->updated_by = auth()->id();
            $master->save();

            // Delete old details
            EmpQualificationDetail::where('mst_id', $id)->delete();

            // Insert new details
            foreach ($request->level as $key => $level) {

                EmpQualificationDetail::create([
                    'mst_id' => $master->mst_id,
                    'education_level' => $level,
                    'group_subject' => $request->subject[$key],
                    'institute_name' => $request->institute[$key],
                    'passing_year' => $request->year[$key],
                    'result_value' => $request->result[$key],
                    'board_university' => $request->board[$key],
                ]);
            }

            DB::commit();

            return redirect()
                ->route('employee.qualification.index')
                ->with('success', 'Qualification updated successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
