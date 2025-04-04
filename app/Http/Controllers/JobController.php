<?php

namespace App\Http\Controllers;

use App\Mail\JobPosted;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

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
    
        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);

        Mail::to($job->employer->user)->send(new JobPosted($job));
    
        return redirect('/jobs');
    }

    public function edit(Job $job)
    {
        // Gate::authorize('edit-job', $job);

        // Another way to do it
        // if(Auth::user()->cannot('edit-job', $job)) {
        //     abort(403);
        // }

        return view('jobs.edit', compact('job'));
    }

    public function update(Job $job)
    {
        // authorize
        // Gate::authorize('edit', $job);
        // it's now in the route

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
        // authorize
        //  Gate::authorize('edit', $job);
        // it's now in the route

        //delete the job
        $job->delete();

        //redirect
        return redirect('/jobs');
    }
}
