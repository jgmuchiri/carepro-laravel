<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveDaycareRequest;
use App\Models\Addresses\Address;
use App\Models\Daycare;
use App\Models\Permissions\Role;
use Config;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Account;

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

        $role = Role::whereName(Role::TENANT_ROLE)->first();
        $user->roles()->sync([$role->id]);

        $exploded_name = explode(' ', $user->name);

        /*Stripe::setApiKey(Config::get('services.stripe.secret'));
        $account = Account::create(
            [
                "country" => "US",
                "managed" => true,
                'business_name' => $daycare->name,
                'email' => $user->email,
                'legal_entity' => [
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
                    'type' => 'company',
                    'personal_address' => [
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
        dd($account); */

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Daycare  $dayCare
     * @return \Illuminate\Http\Response
     */
    public function show(Daycare $dayCare)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Daycare  $dayCare
     * @return \Illuminate\Http\Response
     */
    public function edit(Daycare $dayCare)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Daycare  $dayCare
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Daycare $dayCare)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Daycare  $dayCare
     * @return \Illuminate\Http\Response
     */
    public function destroy(Daycare $dayCare)
    {
        //
    }
}
