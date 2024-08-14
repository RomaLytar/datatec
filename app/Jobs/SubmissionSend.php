<?php

namespace App\Jobs;

use App\Events\SubmissionSaved;
use App\Models\Submission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SubmissionSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $data; //Request data name,email,message
    /**
     * Create a new job instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        $this->onQueue('SubmissionSend');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            //Saved submission
            $submission = Submission::create($this->data);
            //Success save, initialization event
            event(new SubmissionSaved($submission->name, $submission->email));
        } catch (\Exception $e) {
            Log::error('Error saving submission: ' . $e->getMessage());
            throw $e;
        }
    }
}
