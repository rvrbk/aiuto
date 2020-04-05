<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OfferToOfferer extends Mailable
{
    use Queueable, SerializesModels;

    private $help;
    private $offer;
    private $offerer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($help, $offer, $offerer)
    {
        $this->help = $help;
        $this->offer = $offer;
        $this->offerer = $offerer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Thank you for lending ' . $this->help->name . ' a hand!')->view('offer-to-offerer')
            ->with('help', $this->help)
            ->with('offer', $this->offer)
            ->with('offerer', $this->offerer);
    }
}
