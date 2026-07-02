<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

use App\Models\job;


class JobsControllers extends BaseController
{
    public function index()
    {
        $jobs = Job::paginate(5);
//dd($jobs);
        return view('jobs.jobs', compact('jobs'));
    }


    public function store(Request $request)
    {
//        dd($request->max_salary);

        $request->validate([
            'job_id' => 'required',
            'job_title' => 'required|string|max:255',
            'min_salary' => 'nullable|numeric',
            'max_salary' => 'nullable|numeric',
        ]);

        // Create new job
        $job = Job::create([
            'job_id' => $request->job_id,
            'job_title' => $request->job_title,
            'min_salary' => $request->min_salary,
            'max_salary' => $request->max_salary,
        ]);

//        return response()->json([
//            'success' => true,
//            'message' => 'Job created successfully.',
//            'data' => $job
//        ]);
        return redirect()->back()->with('success', 'Department Added');
    }


    public function edit($id)
    {
        $jobs = DB::table('jobs_hr')
            ->orderBy('job_id')
            ->paginate(10);

        $job = DB::table('jobs_hr')
            ->where('job_id', $id)
            ->first();

        return view('Jobs.jobs', compact('jobs', 'job'));
    }

    public function update(Request $request, $id)
    {
        Job::where('job_id', $id)->update([
            'job_title' => $request->job_title,
            'min_salary' => $request->min_salary,
            'max_salary' => $request->max_salary,
        ]);



        return redirect()->route('job.index')->with('success', 'Updated');
    }

}

