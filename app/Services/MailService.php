<?php

namespace App\Services;

use App\User;
use Config;
use Mail;

class MailService
{
    /**
     * Sends the account confirmation email
     *
     * @param User $user
     */
    public static function sendConfirmationEmail(User $user)
    {
        Mail::send(
            'emails.accounts-verify',
            ['confirmation_code' => $user->confirmation_code],
            function ($m) use ($user) {
                $m->from(Config::get('mail.from.address'), Config::get('mail.from.name'));
                $m->to($user->email, $user->name)->subject('Verify your email address');
            }
        );
    }
}
