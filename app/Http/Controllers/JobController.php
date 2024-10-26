<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Job;
use Database\Factories\EmployerFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function index()
    {
        // using with here eager loads employers, so we avoid n+1 problem
        $jobs = Job::with('employer')->latest()->paginate(5);

        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function show(Job $job) {
        return view('jobs.show', ['job' => $job]);
    }

    public function store() {
        $employer = Employer::factory()->create([
            'user_id' => Auth::id(),
        ]);

        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required', 'numeric'],
        ]);

        $job = new Job();
        $job->title = request('title');
        $job->salary = request('salary');
        $job->employer_id = $employer->id;
        $job->save();

        Mail::to($job->employer->user)->queue(new \App\Mail\JobPosted($job));

        return redirect('/jobs');
    }

    public function edit(Job $job) {
        // Handled by the middlware call in the routes file
        //Gate::authorize('edit-job', $job);

        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job) {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required', 'numeric'],
        ]);

        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);

        return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job) {
        $job->delete();

        return redirect('/jobs');
    }
}
