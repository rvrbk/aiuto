<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WeeklyReport extends Mailable
{
    use Queueable, SerializesModels;

    private $help;
    private $offerings;
    private $matches;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($help, $offerings, $matches)
    {
        $this->help = $help;
        $this->offerings = $offerings;
        $this->matches = $matches;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Weekly report')->view('weekly-report')
            ->with('help', $this->help)
            ->with('offerings', $this->offerings)
            ->with('matches', $this->matches);
    }
}
