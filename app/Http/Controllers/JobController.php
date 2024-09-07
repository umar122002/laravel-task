<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Exception;

class JobController extends Controller
{
    public function index()
    {
        try {
            $jobs = Job::all();
            return response()->json($jobs);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to retrieve jobs', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required',
                'description' => 'required',
                'company' => 'required',
                'location' => 'required',
                'salary' => 'required|numeric',
            ]);

            $job = Job::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'company' => $validated['company'],
                'location' => $validated['location'],
                'salary' => $validated['salary'],
                'user_id' => $request->user()->id,
            ]);

            return response()->json($job, 201);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to create job', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $job = Job::findOrFail($id);
            return response()->json($job);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Job not found'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to retrieve job', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $job = Job::findOrFail($id);
            $validated = $request->validate([
                'title' => 'sometimes|required',
                'description' => 'sometimes|required',
                'company' => 'sometimes|required',
                'location' => 'sometimes|required',
                'salary' => 'sometimes|required|numeric',
            ]);

            $job->update($validated);

            return response()->json($job);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Job not found'], 404);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to update job', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $job = Job::findOrFail($id);
            $job->delete();

            return response()->json([
                'message' => 'Job deleted successfully',
                'job_id' => $id
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Job not found'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to delete job', 'error' => $e->getMessage()], 500);
        }
    }
}
