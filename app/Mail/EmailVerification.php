<?php

namespace App\Mail;

use App\Services\EmailVerificationService\EmailVerificationClient;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Подтверждение E-mail | RecruitMe';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        protected EmailVerificationClient $emailVerificationClient
    ) {}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->view('emails.email-verifications', [
            'emailVerificationUrl' => $this->emailVerificationClient->generateUrl()
        ]);
    }
}
