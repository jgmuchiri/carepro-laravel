<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveDaycareRequest;
use App\Models\Addresses\Address;
use App\Models\Daycare;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Stripe\Account;
use Stripe\Stripe;

class DaycaresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('daycares.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SaveDaycareRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SaveDaycareRequest $request)
    {
        $address = Address::createFromRawInput($request->only(
            ['address_line_1', 'address_line_2', 'zip_code', 'state', 'city', 'country', 'phone']
        ));

        $daycare = new Daycare([
            'name' => $request->input('name'),
            'employee_tax_identifier' => $request->input('employee_tax_identifier')]
        );

        $user = $request->user();
        $daycare->address()->associate($address);
        $daycare->owner()->associate($user);

        $daycare->save();

        $user->daycare()->associate($daycare);
        $user->save();

        $exploded_name = explode(' ', $user->name);

        $dob = explode('-',$request->date_of_birth);
            try {
            Stripe::setApiKey(Config::get('services.stripe.secret'));
            $account = Account::create(
                [
                    "country" => "US",
                    'business_name' => $daycare->name,
                    'email' => $user->email,
                    "type" => "custom",
                    'legal_entity' => [
                        'type'=>'company',
                        'address' => [
                            'city' => $address->city->name,
                            'country' => $address->country->abbreviation,
                            'line1' => $address->address_line_1,
                            'line2' => $address->address_line_2,
                            'postal_code' => $address->zipCode->name,
                            'state' => $address->state->name
                        ],
                        'phone_number' => $address->phone,
                        'business_tax_id' => $daycare->employee_tax_identifier,
                        'first_name' => $exploded_name[0],
                        'last_name' => (!empty($exploded_name[1]) ? $exploded_name[1] : null),
                        'personal_address' => [
                            'city' => $user->address->city->name,
                            'country' => $user->address->country->abbreviation,
                            'line1' => $user->address->address_line_1,
                            'line2' => $user->address->address_line_1,
                            'postal_code' => $address->zipCode->zip_code,
                            'state' => $address->state->name
                        ],
                        'dob' => array(
                            'day' => $dob[2],
                            'month' => $dob[1],
                            'year' => $dob[0],
                        ),
                        'ssn_last_4' => $user->ssn_last_four,
                    ],
                    'tos_acceptance' => array(
                        'date' => time(),
                        'ip' => $_SERVER['REMOTE_ADDR']
                    ),
                ]
            );

            $user->stripe_managed_account_id = $account->id;
            $user->stripe_secret_key = $account->keys['secret'];
            $user->stripe_publishable_key = $account->keys['publishable'];
            $user->save();
        } catch (\Exception $exception) {
            Log::error('Failed to create managed account for user id: ' . $user->id .
                '. Message: ' . $exception->getMessage());
            echo $exception->getMessage();
            echo __('Go back and try again');
           // return redirect()->back()->withInput();
        }
        echo __('Please follow instructions received on the email.');
        //return redirect('/home');
    }
}
