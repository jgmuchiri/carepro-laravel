<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Photo;
use Illuminate\Http\Request;
use Image;
use Storage;

class ChildPhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $child = Child::findOrFail($id);

        $photos = Photo::whereChildId($id)->get();

        $photos = $photos->sortByDesc(function ($item, $key) {
            return $item->created_at->timestamp;
        })->groupBy(function ($item, $key) {
            return $item->created_at->toDateString();
        })->toArray();

        $formatted_array = [];
        foreach ($photos as $key => $photo_group) {
            $formatted_array[] = ['key' => $key, 'values' => $photo_group];
        }

        return response()->json(['photos' => $formatted_array]);
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
     * @param int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $child = Child::findOrFail($id);

        $photo_uri = Storage::disk('public')
            ->putFile('children-images/original', $request->file('file'), 'public');
        //get the saved photo name
        $photo_name = basename($photo_uri);
        //retrieve the image
        $file = Storage::get('public/children-images/original/' . $photo_name);
        //resize image
        $photo_thumb = Image::make($file)->resize(100, 100)->stream();
        //move the resized image to the childrens folder.
        $path = Storage::disk('public')->put('children-images/' . $photo_name, $photo_thumb);
        //generate resized image path
        $thumb_path = 'children-images/' . $photo_name;

        $photo = $child->photos()->create(['photo_uri' => $thumb_path]);

        return response()->json(compact('photo'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
