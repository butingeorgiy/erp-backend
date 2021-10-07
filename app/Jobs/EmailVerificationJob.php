<?php

namespace App\Jobs;

use App\Mail\EmailVerification;
use App\Models\User;
use App\Services\EmailVerificationService\EmailVerificationClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EmailVerificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        protected User $user
    ){}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $emailVerificationClient = new EmailVerificationClient($this->user);

        Mail::to($this->user->email)->send(new EmailVerification($emailVerificationClient));
    }
}
