<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriptions\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class SettingsController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $plans = Plan::all();

        return view('admin.settings.edit')->with(compact('plans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $plan = Plan::find($id);

        $plan->fill($request->except('_token'));

        if (!$request->has('has_invoice_due_alert_to_parents')) {
            $plan->has_invoice_due_alert_to_parents = false;
        } else {
            $plan->has_invoice_due_alert_to_parents = true;
        }

        $plan->save();

        return redirect()->back()
            ->with(['successes' => new MessageBag(['Successfully updated plan ' . $plan->name . '.'])]);
    }
}
