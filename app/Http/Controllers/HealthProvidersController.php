<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveHealthProviderRequest;
use App\Models\Addresses\Address;
use App\Models\Child;
use App\Models\HealthProviders\Role;
use App\Models\HealthProviders\HealthProvider;
use Illuminate\Http\Request;

class HealthProvidersController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param int $child_id
     * @param  SaveHealthProviderRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store($child_id, SaveHealthProviderRequest $request)
    {
        $child = Child::findOrFail($child_id);
        $this->authorize('update', $child);

        $health_provider = new HealthProvider([
            'name' => $request->input('name'),
            'remarks' => $request->input('remarks')
        ]);

        $health_provider->child()->associate($child);

        $role = Role::firstOrCreate(['name' => $request->input('role')]);
        $health_provider->role()->associate($role);

        $address = Address::createFromRawInput($request->input());
        $health_provider->address()->associate($address);

        $health_provider->save();
        $health_provider->load([
            'child',
            'role',
            'address.city',
            'address.state',
            'address.zipCode',
            'address.country'
        ]);

        return response()->json(
            [
                'health_provider' => $health_provider,
                'message' => __('Successfully saved health provider.')
            ],
            201
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SaveHealthProviderRequest  $request
     * @param int $child_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveHealthProviderRequest $request, $child_id, $id)
    {
        $child = Child::findOrFail($child_id);
        $this->authorize('update', $child);

        $health_provider = HealthProvider::findOrFail($id);

        $health_provider->fill([
            'name' => $request->input('name'),
            'remarks' => $request->input('remarks')
        ]);

        $role = Role::firstOrCreate(['name' => $request->input('role')]);
        $health_provider->role()->associate($role);

        $health_provider->address->updateFromRawInput($request->input());

        $health_provider->save();
        $health_provider->load([
            'child',
            'role',
            'address.city',
            'address.state',
            'address.zipCode',
            'address.country'
        ]);

        return response()->json(
            [
                'health_provider' => $health_provider,
                'message' => __('Successfully saved health provider.')
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $child_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($child_id, $id)
    {
        $child = Child::findOrFail($child_id);
        $this->authorize('update', $child);

        $health_provider = HealthProvider::findOrFail($id);
        $health_provider->delete();

        return response()->json(['message' => __('Successfully deleted health provider.')]);
    }
}
