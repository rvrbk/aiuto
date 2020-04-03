<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OfferToCaller extends Mailable
{
    use Queueable, SerializesModels;

    private $help;
    private $offer;
    private $offerer;
    private $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($help, $offer, $offerer, $token)
    {
        $this->help = $help;
        $this->offer = $offer;
        $this->offerer = $offerer;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('offer-to-caller')
            ->with('help', $this->help)
            ->with('offer', $this->offer)
            ->with('offerer', $this->offerer)
            ->with('token', $this->token);
    }
}
