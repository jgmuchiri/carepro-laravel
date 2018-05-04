<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodPreference;
use App\Models\Child;

class FoodpreferenceController extends Controller
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
            'preffered_time' => 'required',
        ]);

        $preference = new FoodPreference;
        $preference->fill($request->all());
        $preference->child_id = $id;
        $preference->save();

        return response()->json([
            'status' => 'okay',
            'status_code' => '200',
            'message' => 'Food Preference record has been created',
            'preference' => $preference
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
    public function update(Request $request, $id)
    {
        $child = Child::findOrFail($id);
        $this->authorize('update', $child);

        $this->validate($request, [
            'name' => 'required|max:255',
            'remarks' => 'required',
            'preffered_time' => 'required',
        ]);

        $preference = FoodPreference::find($id);
        $preference->fill($request->all());
        $preference->child_id = $id;
        $preference->save();

        return response()->json([
            'status' => 'okay',
            'status_code' => '200',
            'message' => 'Food Preference record has been created',
            'preference' => $preference
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

        $preference = FoodPreference::findOrFail($id);
        $preference->delete();

        return response()->json(['message' => __('Successfully deleted Food Preference record.')]);
    }
}
