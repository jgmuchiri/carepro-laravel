<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\PickupUsers\PickupUser;
use App\Models\PickupUsers\Relation;
use Illuminate\Http\Request;
use Image;
use Storage;

class PickupUsersController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param int $child_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($child_id, Request $request)
    {
        $child = Child::findOrFail($child_id);
        $this->authorize('update', $child);

        $photo_uri = Storage::disk('public')->putFile('children-images/pickup-users/original', $request->file('photo_uri'), 'public');
        //get the saved photo name
        $photo_name = basename($photo_uri);
        //retrieve the image
        $file = Storage::get('public/children-images/pickup-users/original/'.$photo_name);
        //resize image
        $photo_thumb = Image::make($file)->resize(100, 100)->stream();
        //move the resized image to the childrens folder.
        $path = Storage::disk('public')->put('children-images/pickup-users/'.$photo_name, $photo_thumb);
        //generate resized image path
        $thumb_path = 'children-images/pickup-users/' . $photo_name;

        $pickup_user = new PickupUser([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'pin' => $request->input('pin'),
            'photo_uri' => $thumb_path
        ]);

        $pickup_user->child()->associate($child);

        $relation = Relation::firstOrCreate(['name' => $request->input('relation')]);
        $pickup_user->relation()->associate($relation);

        $pickup_user->save();
        $pickup_user->load(['child', 'relation']);

        return response()->json(
            [
                'pickup_user' => $pickup_user,
                'message' => __('Successfully saved pickup user.')
            ],
            201
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $child_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $child_id, $id)
    {
        $child = Child::findOrFail($child_id);
        $this->authorize('update', $child);

        $pickup_user = PickupUser::findOrFail($id);

        if (!empty($request->file('photo_uri'))) {
            $photo_uri = $pickup_user->photo_uri;
            Storage::disk('public')->putFileAs('children-images/pickup-users/original', $request->file('photo_uri'),
                $photo_uri);

            //retrieve the image
            $file = Storage::get('public/children-images/pickup-users/original/' . $photo_uri);
            //resize image
            $photo_thumb = Image::make($file)->resize(100, 100)->stream();
            //move the resized image to the childrens folder.
            $path = Storage::disk('public')->put($photo_uri, $photo_thumb);
        }

        $pickup_user->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'pin' => $request->input('pin'),
        ]);

        $relation = Relation::firstOrCreate(['name' => $request->input('relation')]);
        $pickup_user->relation()->associate($relation);

        $pickup_user->save();
        $pickup_user->load(['child', 'relation']);

        return response()->json(
            [
                'pickup_user' => $pickup_user,
                'message' => __('Successfully saved pickup user.')
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

        $pickup_user = PickupUser::findOrFail($id);
        $pickup_user->delete();

        return response()->json(['message' => __('Successfully deleted pickup user.')]);
    }
}
