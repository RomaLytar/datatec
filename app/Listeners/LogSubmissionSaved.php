<?php

namespace App\Listeners;

use App\Events\SubmissionSaved;
use Illuminate\Support\Facades\Log;

class LogSubmissionSaved
{
    /**
     * Handle the event.
     */
    public function handle(SubmissionSaved $event): void
    {
        // логирование
        Log::info("Submission saved: Name - {$event->name}, Email - {$event->email}");
    }
}
