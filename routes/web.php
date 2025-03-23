<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/contact', 'contact');
Route::resource('jobs', JobController::class);

// Route::get('/', function () {
//     return view('home');
// });

//Route Model Binding: e.g.: Route::get('/posts/{post:slug}', function(Post $post) {});

// Route::controller(JobController::class)->group(function () {
//     Route::get('/jobs', 'index');
//     Route::get('/jobs/create', 'create');
//     Route::get('/jobs/{job}', 'show');
//     Route::post('/jobs', 'store');
//     Route::get('/jobs/{job}/edit', 'edit');
//     Route::patch('/jobs/{job}', 'update');
//     Route::delete('/jobs/{job}', 'destroy');
// });

// Route::resource('jobs', JobController::class, [
//     //'except' => ['edit'],          => All but not this/these
//     //'only' => ['index', 'show']    => Only this/these
// ]);