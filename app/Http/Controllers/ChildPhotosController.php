<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveChildPhotoRequest;
use App\Models\Child;
use App\Models\Photo;
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
        $this->authorize('show', $child);

        $photos = Photo::whereChildId($id)->get();

        $photos = $photos->sortByDesc(function ($item, $key) {
            return $item->created_at->timestamp;
        })->groupBy(function ($item, $key) {
            return $item->created_at->toDateString();
        })->toArray();

        $formatted_array = [];
        $index = 0;
        foreach ($photos as $key => $photo_group) {
            $formatted_array[] = ['key' => $key, 'index' => null, 'values' => $photo_group];
        }

        return response()->json(['photos' => $formatted_array]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $id
     * @param  SaveChildPhotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, SaveChildPhotoRequest $request)
    {
        $child = Child::findOrFail($id);
        $this->authorize('update', $child);

        $photo_uri = Storage::disk('public')
            ->putFile('children-images/original', $request->file('file'), 'public');
        //get the saved photo name
        $photo_name = basename($photo_uri);
        //retrieve the image
        $file = Storage::get('public/children-images/original/' . $photo_name);
        //resize image
        $photo_thumb = Image::make($file)->resize(200, 200)->stream();
        //move the resized image to the childrens folder.
        $path = Storage::disk('public')->put('children-images/' . $photo_name, $photo_thumb);
        //generate resized image path
        $thumb_path = 'children-images/' . $photo_name;

        $photo = $child->photos()->create(['photo_uri' => $thumb_path]);

        return response()->json(compact('photo'));
    }
}
