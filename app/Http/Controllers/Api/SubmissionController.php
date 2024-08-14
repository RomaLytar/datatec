<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubmissionRequest;
use App\Jobs\SubmissionSend;
use Illuminate\Support\Facades\Log;

class SubmissionController extends Controller
{
    public function submit(SubmissionRequest $request){
        Log::info('Test log entry');
        try {
            //start job
            SubmissionSend::dispatch($request->validated());
            return response()->json([
                'message' => 'Submission is being processed!',
            ], 202);

        } catch (\Exception $e) {
            Log::error('Error processing submission: ' . $e->getMessage());
            return response()->json([
                'error' => 'There was an error processing your submission.',
            ], 500);
        }
    }
}
