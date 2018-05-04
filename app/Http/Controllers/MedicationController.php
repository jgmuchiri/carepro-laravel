<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medication;
use App\Models\Child;

class MedicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $medication = Medication::where('child_id', $id)->latest()->get();

        return $medication;
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
            'frequency' => 'required',
            'start' => 'required|date',
            'stop' => 'required|date',
        ]);

        $medication = new Medication;
        $medication->fill($request->all());
        $medication->child_id = $id;
        $medication->save();

        return response()->json([
            'status' => 'okay',
            'status_code' => '200',
            'message' => 'Medical record has been created',
            'medication' => $medication
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
    public function update(Request $request, $id, $medication_id)
    {
        $child = Child::findOrFail($id);
        $this->authorize('update', $child);

        $this->validate($request, [
            'name' => 'required|max:255',
            'frequency' => 'required',
            'start' => 'required|date',
            'stop' => 'required|date',
        ]);

        $medication = Medication::find($medication_id);
        $medication->fill($request->all());
        $medication->child_id = $id;
        $medication->save();

        return response()->json([
            'status' => 'okay',
            'status_code' => '200',
            'message' => 'Medication record has been updated',
            'medication' => $medication
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

        $medication = Medication::findOrFail($id);
        $medication->delete();

        return response()->json(['message' => __('Successfully deleted Medication record.')]);
    }
}
