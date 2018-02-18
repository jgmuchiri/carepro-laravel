<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Notes\IncidentType;
use App\Models\Notes\Location;
use App\Models\Notes\Note;
use App\Models\Notes\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use Storage;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $notes = Note::with([
            'type',
            'createdByUser',
            'children',
            'location',
            'incidentType'
        ])->orderByDesc('created_at')->whereChildId($id)->get();

        return response()->json(compact('notes'));
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
        $this->authorize('update', $child);

        $note = new Note([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'created_at' => $request->input('created_at')
        ]);

        if ($request->has('witnesses')) {
            $note->witnesses = $request->input('witnesses');
        }

        if ($request->has('action_taken')) {
            $note->action_taken = $request->input('action_taken');
        }

        if ($request->has('remarks')) {
            $note->remarks = $request->input('remarks');
        }

        if ($request->has('location')) {
            $location = Location::firstOrCreate(['name' => $request->input('location')]);
            $note->location()->associate($location);
        }

        if ($request->has('incident_type')) {
            $incident_type = IncidentType::firstOrCreate(['name' => $request->input('incident_type')]);
            $note->incidentType()->associate($incident_type);
        }

        $type = Type::whereName($request->input('note_type'))->first();
        $note->type()->associate($type);
        $note->createdByUser()->associate(Auth::user());
        $note->save();

        $note->children()->save($child);

        if (!empty($request->file('photo_uris'))) {
            foreach ($request->file('photo_uris') as $photo) {
                $photo_uri = Storage::disk('public')
                    ->putFile('children-images/original', $photo, 'public');
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

                $note->photos()->create(['photo_uri' => $thumb_path]);
            }
        }

        $note->load([
            'type',
            'createdByUser',
            'children',
            'location',
            'incidentType'
        ]);

        return response()->json(
            ['note' => $note, 'message' => __('Successfully created note.')],
            201
        );
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
     * @param int $child_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($child_id, $note_id)
    {
        $child = Child::findOrFail($child_id);
        $note = Note::findOrFail($note_id);
        $this->authorize('update', $child);

        $note->delete();

        return response()->json(['message' => __('Note successfully deleted.')]);
    }
}
