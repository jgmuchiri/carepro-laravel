<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveEmergencyContactRequest;
use App\Models\Addresses\Address;
use App\Models\Child;
use App\Models\EmergencyContact;
use App\Models\PickupUsers\Relation;
use Illuminate\Http\Request;

class EmergencyContactsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param int $child_id
     * @param  SaveEmergencyContactRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store($child_id, SaveEmergencyContactRequest $request)
    {
        $child = Child::findOrFail($child_id);
        $this->authorize('update', $child);

        $emergency_contact = new EmergencyContact([
            'name' => $request->input('name')
        ]);

        $emergency_contact->child()->associate($child);

        $relation = Relation::firstOrCreate(['name' => $request->input('relation')]);
        $emergency_contact->relation()->associate($relation);

        $address = Address::createFromRawInput($request->input());
        $emergency_contact->address()->associate($address);

        $emergency_contact->save();
        $emergency_contact->load([
            'child',
            'relation',
            'address.city',
            'address.state',
            'address.zipCode',
            'address.country'
        ]);

        return response()->json(
            [
                'emergency_contact' => $emergency_contact,
                'message' => __('Successfully saved emergency contact.')
            ],
            201
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SaveEmergencyContactRequest $request
     * @param int $child_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveEmergencyContactRequest $request, $child_id, $id)
    {
        $child = Child::findOrFail($child_id);
        $this->authorize('update', $child);

        $emergency_contact = EmergencyContact::findOrFail($id);

        $emergency_contact->fill([
            'name' => $request->input('name'),
        ]);

        $relation = Relation::firstOrCreate(['name' => $request->input('relation')]);
        $emergency_contact->relation()->associate($relation);

        $emergency_contact->address->updateFromRawInput($request->input());

        $emergency_contact->save();
        $emergency_contact->load([
            'child',
            'relation',
            'address.city',
            'address.state',
            'address.zipCode',
            'address.country'
        ]);

        return response()->json(
            [
                'emergency_contact' => $emergency_contact,
                'message' => __('Successfully saved emergency contact.')
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

        $emergency_contact = EmergencyContact::findOrFail($id);
        $emergency_contact->delete();

        return response()->json(['message' => __('Successfully deleted emergency contact.')]);
    }
}
