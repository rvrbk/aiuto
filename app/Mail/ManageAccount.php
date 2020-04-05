<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ManageAccount extends Mailable
{
    use Queueable, SerializesModels;

    private $help;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($help)
    {
        $this->help = $help;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Manage your call ' . $this->help->title)->view('manage-account')
            ->with('help', $this->help);
    }
}
