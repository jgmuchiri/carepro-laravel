<?php

namespace App\Services;

use App\Models\Staff;
use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

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
                $m->to($user->email, $user->name)->subject(__('Verify your email address'));
            }
        );
    }

    public static function notifyUserAccountChange($user)
    {
        Mail::send(
            'emails.accounts-changed',
            ['confirmation_code' => $user->confirmation_code],
            function ($m) use ($user) {
                $m->from(Config::get('mail.from.address'), Config::get('mail.from.name'));
                $m->to($user->email, $user->name)->subject(__("Your account was recently updated"));
            }
        );
    }

    /**
     * Sends the parent registered child email
     *
     * @param User $user
     */
    public static function sendParentRegisteredChildEmail(User $user)
    {
        $staff = Staff::whereDaycareId($user->daycare->id)->get();
        $tenant = User::find($staff->first()->user->daycare->owner);

        $to = [
            'emails' => $staff->pluck('email')->merge($tenant->email),
            'names' => $staff->pluck('name')->merge($tenant->name)
        ];

        Mail::send(
            'emails.parent-registered-child',
            [],
            function ($m) use ($to) {
                $m->from(Config::get('mail.from.address'), Config::get('mail.from.name'));
                $m->to($to['emails']->toArray(), $to['names']->toArray())->subject(__('Verify your email address'));
            }
        );
    }
}
