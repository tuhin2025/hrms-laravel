<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\job;
use App\Models\notifications;
use App\Models\Users;

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
        DB::beginTransaction();
        try {
            // Create new job
            $job = Job::create([
                'job_id' => $request->job_id,
                'job_title' => $request->job_title,
                'min_salary' => $request->min_salary,
                'max_salary' => $request->max_salary,
            ]);

// Notify all users
            $users = Users::all();
            //$loginUser = auth()->id();
            $loginUser = Auth::user();
//        dd($loginUser);

            foreach ($users as $user) {
                notifications::create([
                    'title' => 'New Job Created',
                    'message' => 'A new job "' . $job->job_title . '" has been created.',
                    'type' => 'job',
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

    public function delete($id)
    {
        Job::where('job_id', $id)->delete();

        return redirect()->back()->with('success', 'Deleted');
    }

}

