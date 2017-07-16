<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveGroupRequest;
use App\Models\Child;
use App\Models\Groups\Group;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('showGeneric', Group::class);
        $daycare_id = $request->user()->daycare->id;
        $groups = Group::whereDaycareId($daycare_id)->with(['staff.user', 'children'])->get();
        $children = Child::whereDaycareId($daycare_id)->get();
        $staff = Staff::whereDaycareId($daycare_id)->with(['user'])->get();

        return view('groups.index')->with(compact('groups', 'children', 'staff'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SaveGroupRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SaveGroupRequest $request)
    {
        $this->authorize('store', Group::class);
        if (!$request->has('staff')) {
            return redirect()->route('groups.index')
                ->withErrors(__('A staff must be selected.'));
        }

        if (!$request->has('children')) {
            return redirect()->route('groups.index')
                ->withErrors(__('A child must be selected.'));
        }

        $group = new Group([
            'name' => $request->input('name'),
            'short_description' => $request->input('description'),
            'daycare_id' => $request->user()->daycare_id
        ]);

        $group->save();
        $group->staff()->sync($request->input('staff'));
        $group->children()->sync($request->input('children'));

        return redirect()->route('groups.index')
            ->with(['successes' => new MessageBag([__('Successfully saved group.')])]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Group::with(['children', 'staff.user'])->find($id);
        $this->authorize('show', $group);

        return view('groups.show')->with(compact('group'));
    }
}
