<?php

namespace App\Mail;

use App\Models\Job;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobApplicationSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $candidate;
    public $job;

    /**
     * Create a new message instance.
     */
    public function __construct(User $candidate, Job $job)
    {
        $this->candidate = $candidate;
        $this->job = $job;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Lamaran Anda Untuk Posisi ' . $this->job->title . ' Berhasil Dikirim',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.job-application-submitted',
            with: [
                'candidateName' => $this->candidate->name,
                'jobTitle' => $this->job->title,
                'companyName' => $this->job->company?->name ?? 'Perusahaan',
                'jobLocation' => $this->job->location,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
