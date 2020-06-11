<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveDaycareRequest;
use App\Models\Addresses\Address;
use App\Models\Daycare;
use Config;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        return view('daycares.create');
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
        $user = $request->user();

        if (is_null($user->daycare_id)) {
            $address = Address::createFromRawInput($request->only(
                'address_line_1',
                'address_line_2',
                'zip_code',
                'state',
                'city',
                'country',
                'phone'
            ));

            $daycare = new Daycare;
            $daycare->name = $request->name;
            $daycare->employee_tax_identifier = $request->employee_tax_identifier;
            $daycare->address_id = $address->id;
            $daycare->owner_user_id = $user->id;
            $daycare->trial_ends_at = Carbon::now()->addDays(14);
            $daycare->save();

            $user->daycare_id = $daycare->id;
            $user->save();
        } else {
            $daycare = Daycare::find($user->daycare_id);
            $daycare->name = $request->name;
            $daycare->employee_tax_identifier = $request->employee_tax_identifier;
            $daycare->trial_ends_at = Carbon::now()->addDays(14);
            $daycare->save();
            $address = Address::find($daycare->address_id);
            $address->phone = $request->phone;
            $address->phone = $request->country;
            $address->phone = $request->city;
            $address->phone = $request->state;
            $address->phone = $request->zip_code;
            $address->phone = $request->address_line_1;
            $address->phone = $request->address_line_2;
            $address->save();
        }

        $exploded_name = explode(' ', $user->name);

        try {
            \Stripe\Stripe::setApiKey(Config::get('services.stripe.secret'));
            $account = \Stripe\Account::create(
                [
                    "country" => "US",
                    "type" => "custom", 
                    'email' => $user->email,
                    'business_profile' => [
                        'name'=>$daycare->name,
                        'product_description'=>'Daycare Services',
                        'support_address' => [
                            'city' => $address->city->name,
                            'country' => $address->country->abbreviation,
                            'line1' => $address->address_line_1,
                            'line2' => $address->address_line_2,
                            'postal_code' => $address->zipCode->name,
                            'state' => $address->state->name
                        ],
                        'support_phone' => $address->phone,
                        // 'business_tax_id' => $daycare->employee_tax_identifier,
                        // 'first_name' => $exploded_name[0],
                        // 'last_name' => (!empty($exploded_name[1]) ? $exploded_name[1] : null), 
                    ],
                    'business_type' => 'individual',
                    'requested_capabilities'=>['card_payments','transfers'],
                    'individual' => [
                        'address'=>[
                            'city' => $user->address->city->name,
                            'country' => $user->address->country->abbreviation,
                            'line1' => $user->address->line1,
                            'line2' => $user->address->line2,
                            'postal_code' => $address->zipCode->name,
                            'state' => $address->state->name
                        ]
                       ]
                ]
            );

            $managed_account = $daycare->managed_account()->create([
                'stripe_managed_account_id' => $account->id,
                'stripe_secret_key' =>$account->keys['secret'],
                'stripe_publishable_key' =>$account->keys['publishable'],
            ]);
        } catch (\Exception $exception) {
            $error = $exception->getMessage();
            \Log::error('Failed to create managed account for user id: ' . $user->id .
                '. Message: ' . $error);
            return redirect()->back()->withErrors(['error' => $error])->withInput($request->all());
        }

        return redirect('/home');
    }
}
