<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// --------------------- Course stuff ---------------------------

Route::view('/home', 'Home');
Route::view('/about', 'About');
Route::view('/contact', 'Contact');


// This little fucker does the same thing as all of the shit below, cuz laravel likes conventions
//Route::resource('jobs', JobController::class);

Route::controller(JobController::class)->group(function () {
    Route::get(   '/jobs',            'index');
    Route::get(   '/jobs/create' ,    'create');
    Route::post(  '/jobs',            'store')->middleware('auth');
    Route::get(   '/jobs/{job}',      'show');
    Route::get(   '/jobs/{job}/edit', 'edit')->middleware('auth')
//        ->can('edit-job', 'job'); This is how you would use a gate, could also do it in middleware array
        ->can('edit', 'job'); // and this calls the function in JobPolicy
    Route::patch( '/jobs/{job}',      'update');
    Route::delete('/jobs/{job}',      'destroy');
});

Route::get('/queueTest', function () {
    $job = \App\Models\Job::first();

    \App\Jobs\TranslateJob::dispatch($job);
    return 'Done';
});




