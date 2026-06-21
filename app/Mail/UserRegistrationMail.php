<?php

namespace App\Mail;

use App\Models\Users;
use Illuminate\Mail\Mailable;

class UserRegistrationMail extends Mailable
{
    public $user;

    public function __construct(Users $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Registration Successful')
            ->view('emails.registration');
    }
}
