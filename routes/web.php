<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

//Index
Route::get('/jobs', function () {
    //Job::all(); -> lazy loading, but we prevent this on the AppServiceProvider
    //Job::with('employer')->get(); -> eager loading

    // $jobs = Job::with('employer')->paginate(5);
    // $jobs = Job::with('employer')->simplePaginate(5);
    // $jobs = Job::with('employer')->cursorPaginate(5);

    $jobs = Job::with('employer')->latest()->simplePaginate(5);
    return view('jobs.index', ['jobs' => $jobs]);
});

//Create
Route::get('/jobs/create', function() {
    return view('jobs.create');
});

//Show
//Route Model Binding
//e.g.: Route::get('/posts/{post:slug}', function(Post $post) {});
Route::get('/jobs/{job}', function(Job $job) {
    return view('jobs.show', compact('job'));
});

//Store
Route::post('/jobs', function() {
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
});

//Edit
Route::get('/jobs/{job}/edit', function(Job $job) {
    return view('jobs.edit', compact('job'));
});

//Update
Route::patch('/jobs/{job}', function(Job $job) {
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
});

//Destroy
Route::delete('/jobs/{job}', function(Job $job) {
    // authorize (on hold...)

    //delete the job
    $job->delete();

    //redirect
    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});