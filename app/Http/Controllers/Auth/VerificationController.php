<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\MailService;
use App\User;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Session;
use Validator;

class VerificationController extends Controller
{
    /**
     * Verifies a user account
     *
     * @param Request $request
     * @param string $confirmation_code
     *
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function verify(Request $request, $confirmation_code)
    {
        $user = User::whereConfirmationCode($confirmation_code)->first();

        if (empty($user)) {
            return abort(404);
        }

        $user->confirmed = true;
        $user->save();

        return redirect('/home')
            ->with(['successes' => new MessageBag(['Successfully confirmed account.'])]);
    }

    /**
     * Resends verification email
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resendVerificationEmail(Request $request)
    {
        MailService::sendConfirmationEmail($request->user());

        return redirect('/home')
            ->with(['successes' => new MessageBag(
                ['Successfully sent verification email. Please check your email inbox'])
            ]);
    }


}
