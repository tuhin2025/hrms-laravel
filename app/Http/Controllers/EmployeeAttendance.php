<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\EmpAttendance;
use App\Models\Employee;
use App\Models\Shifts;
use Illuminate\Support\Facades\DB;
use Carbon\CarbonPeriod;

class EmployeeAttendance extends BaseController
{
    public function index(Request $request)
    {
        $attendances = EmpAttendance::with('employee', 'shift')
            ->when($request->employee_id, function ($q) use ($request) {
                $q->where('employee_id', $request->employee_id);
            })
            ->when($request->from_date && $request->to_date, function ($q) use ($request) {
                $q->whereBetween('attendance_date', [$request->from_date, $request->to_date]);
            })
            ->orderBy('attendance_date', 'desc')
            ->paginate(15);


        $employees = Employee::all();
        $shifts = Shifts::all();

        return view('emp_attendance.index', compact('attendances', 'employees', 'shifts'));

    }

    public function bulkStore(Request $request)
    {
        try {

            $request->validate([
                'employee_id' => 'required',
                'from_date' => 'required',
                'to_date' => 'required',
                'status' => 'required',
            ]);

            $period = CarbonPeriod::create($request->from_date, $request->to_date);

            foreach ($period as $date) {

                EmpAttendance::updateOrCreate(
                    [
                        'employee_id' => $request->employee_id,
                        'attendance_date' => $date->format('Y-m-d'),
                    ],
                    [
                        'shift_id' => $request->shift_id,
                        'status' => $request->status,
                    ]
                );
            }

            return response()->json([
                'message' => 'Bulk Attendance Saved Successfully'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

}


