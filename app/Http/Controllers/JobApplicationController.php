<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Exception;

class JobApplicationController extends Controller
{
    public function apply(Request $request, $jobId)
    {
        try {

            $request->validate([
                'cover_letter' => 'nullable|string',
            ]);

            $job = Job::findOrFail($jobId);


            if ($request->user()->jobsApplied()->where('job_id', $jobId)->exists()) {
                return response()->json(['message' => 'You have already applied to this job'], 400);
            }


            $request->user()->jobsApplied()->attach($jobId, [
                'cover_letter' => $request->cover_letter,
                'status' => 'pending',
            ]);

            $application = $request->user()->jobsApplied()->where('job_id', $jobId)->first();

            return response()->json([
                'message' => 'Application submitted successfully',
                'application' => [
                    'id' => $application->pivot->id,
                    'user_id' => $request->user()->id,
                    'job_id' => $jobId,
                    'status' => $application->pivot->status,
                    'cover_letter' => $application->pivot->cover_letter,
                ]
            ], 201);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Job not found'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to apply for job', 'error' => $e->getMessage()], 500);
        }
    }

    public function myApplications(Request $request)
    {
        try {
            $applications = $request->user()->jobsApplied()->get();
    
            return response()->json($applications);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to retrieve applications', 'error' => $e->getMessage()], 500);
        }
    }
     

    public function viewApplications($jobId)
    {
        try {
            $job = Job::where('id', $jobId)
                ->firstOrFail();

            return response()->json($job);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Job not found'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to retrieve job applications', 'error' => $e->getMessage()], 500);
        }
    }
}
