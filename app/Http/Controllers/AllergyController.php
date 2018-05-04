<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Allergy;
use App\Models\Child;

class AllergyController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $child = Child::findOrFail($id);
        $this->authorize('update', $child);

        $this->validate($request, [
            'name' => 'required|max:255',
            'remarks' => 'required',
            'treatment' => 'required',
            'date_first_noted' => 'required|date',
            'last_event_date' => 'required|date',
        ]);

        $allergy = new Allergy;
        $allergy->fill($request->all());
        $allergy->child_id = $id;
        $allergy->save();

        return response()->json([
            'status' => 'okay',
            'status_code' => '200',
            'message' => 'Allergy record has been created',
            'allergy' => $allergy
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $allergy_id)
    {
        $child = Child::findOrFail($id);
        $this->authorize('update', $child);

        $this->validate($request, [
            'name' => 'required|max:255',
            'remarks' => 'required',
            'treatment' => 'required',
            'date_first_noted' => 'required|date',
            'last_event_date' => 'required|date',
        ]);

        $allergy = Allergy::find($allergy_id);
        $allergy->fill($request->all());
        $allergy->save();

        return response()->json([
            'status' => 'okay',
            'status_code' => '200',
            'message' => 'Allergy record has been updated',
            'allergy' => $allergy
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($child_id, $id)
    {
        $child = Child::findOrFail($child_id);
        $this->authorize('update', $child);

        $allergy = Allergy::findOrFail($id);
        $allergy->delete();

        return response()->json(['message' => __('Successfully deleted Allergy record.')]);
    }
}
