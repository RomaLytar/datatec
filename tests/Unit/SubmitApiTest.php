<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Jobs\SubmissionSend;
use App\Events\SubmissionSaved;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;

class SubmitApiTest extends TestCase
{
    /**
     * Test that the API successfully processes valid data.
     *
     * @return void
     */
    public function submitSuccess()
    {
        // Arrange: Set up data and mock event
        Queue::fake();
        Event::fake();

        $data = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'message' => 'This is a valid message with more than 20 characters.'
        ];

        $response = $this->postJson('/api/submit', $data);
        $response->assertStatus(202)
            ->assertJson(['message' => 'Submission is being processed!']);

        Queue::assertPushed(SubmissionSend::class, function ($job) use ($data) {
            return $job->data['name'] === 'John Doe' &&
                $job->data['email'] === 'johndoe@example.com' &&
                $job->data['message'] === 'This is a valid message with more than 20 characters.';
        });
        Event::assertDispatched(SubmissionSaved::class);
    }

    /**
     * Test that the API returns validation errors for invalid data.
     *
     * @return void
     */
    public function submitValidationErrors()
    {
        $data = [
            'name' => '',
            'email' => 'invalid-email',
            'message' => 'Short'
        ];
        $response = $this->postJson('/api/submit', $data);
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'message']);
    }
}
