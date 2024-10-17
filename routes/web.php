<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Arr;
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
$jobs = [
    [
        'id' => 1,
        'title' => 'Director',
        'salary' => '$50,000'
    ],
    [
        'id' => 2,
        'title' => 'Programmer',
        'salary' => '$100,000'
    ],
    [
        'id' => 3,
        'title' => 'Teacher',
        'salary' => '$150,000'
    ]
];

Route::get('/jobs', function () use($jobs) {
    return view('Jobs', [
        'jobs' => $jobs
    ]);
});

Route::get('/jobs/{id}', function ($id) use($jobs) {
    $job = Arr::first($jobs, fn($job) => $job['id'] == $id);

    return view('Job', ['job' => $job]);
});

Route::get('/home', function () {
    return view('Home');
});

Route::get('/about', function () {
   return view('About');
});

Route::get('/contact', function () {
    return view('Contact');
});
