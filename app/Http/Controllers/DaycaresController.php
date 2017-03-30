<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveDaycareRequest;
use App\Models\Addresses\Address;
use App\Models\Daycare;
use Illuminate\Http\Request;

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

        $daycare->address()->associate($address);
        $daycare->owner()->associate($request->user());

        $daycare->save();

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
