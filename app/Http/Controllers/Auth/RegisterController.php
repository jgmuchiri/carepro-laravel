<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Addresses\Address;
use App\Models\Permissions\Role;
use App\Models\Subscriptions\Plan;
use App\Services\MailService;
use App\User;
use Carbon\Carbon;
use Config;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Mail;
use Session;
use Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm(Request $request)
    {
        if (!$request->session()->has('trial_plan')) {
            return redirect()->route('plans');
        }

        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            array_merge(
                [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|min:6|confirmed'
                ],
                Address::getRules()
            )
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'confirmation_code' => str_random(30)
        ]);

        $address = Address::createFromRawInput($data);
        $user->address()->associate($address);

        $user->save();

        $role = Role::whereName(Role::TENANT_ROLE)->first();
        $user->roles()->sync([$role->id]);

        $plan = Plan::whereName(session('trial_plan'))->first();

        if (empty($plan)) {
            return redirect()->route('plans')->withErrors(__('You must select a plan before registering.'));
        }

        $user->trial_ends_at = Carbon::now()->addDays(14);
        $user->trialPlan()->associate($plan);
        $user->save();
        $this->redirectTo = route('daycare.create');

        MailService::sendConfirmationEmail($user);

        return $user;
    }

    /**
     * Returns where a user should be redirected to after registering
     *
     * @return string
     */
    protected function redirectTo()
    {
        return route('daycare.create');
    }
}
