<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        //Job::all(); -> lazy loading, but we prevent this on the AppServiceProvider
        //Job::with('employer')->get(); -> eager loading

        // $jobs = Job::with('employer')->paginate(5);
        // $jobs = Job::with('employer')->simplePaginate(5);
        // $jobs = Job::with('employer')->cursorPaginate(5);

        $jobs = Job::with('employer')->latest()->simplePaginate(5);
        return view('jobs.index', ['jobs' => $jobs]);
    }

    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store()
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);
    
        Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);
    
        return redirect('/jobs');
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', compact('job'));
    }

    public function update(Job $job)
    {
        // authorize (on hold...)

        // validate
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);

        // update the job and persist
        $job->update([
            'title' => request('title'),
            'salary' => request('salary')
        ]);

        // redirect to the job page
        return redirect("/jobs/{$job->id}");
    }

    public function destroy(Job $job)
    {
         // authorize (on hold...)

        //delete the job
        $job->delete();

        //redirect
        return redirect('/jobs');
    }
}
