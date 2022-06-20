<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailToSubscribeUser extends Mailable
{
    use Queueable, SerializesModels;
    private $title;
    private $description;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Post created!')->view('emails.welcome')->with([
            'title' => $this->title,
            'description' => $this->description
        ]);
    }
}
