<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
    //Job::all(); -> lazy loading, but we prevent this on the AppServiceProvider
    //Job::with('employer')->get(); -> eager loading

    // $jobs = Job::with('employer')->paginate(5);
    // $jobs = Job::with('employer')->simplePaginate(5);
    $jobs = Job::with('employer')->cursorPaginate(5);

    return view('jobs', ['jobs' => $jobs]);
});

Route::get('/jobs/{id}', function($id) {
    $job = Job::find($id);
    return view('job', compact('job'));
});

Route::get('/contact', function () {
    return view('contact');
});