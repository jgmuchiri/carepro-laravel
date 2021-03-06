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
        $groups = Group::whereDaycareId($daycare_id)->withCount(['staff', 'children'])->get();

        return response()->json(compact('groups'));
    }

    public function create(Request $request)
    {
        $this->authorize('create', Group::class);

        $daycare_id = $request->user()->daycare->id;
        $children = Child::whereDaycareId($daycare_id)->get();
        $staff = Staff::whereDaycareId($daycare_id)->with(['user'])->get();

        return response()->json(compact('children', 'staff'));
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

        $group = new Group([
            'name' => $request->input('name'),
            'short_description' => $request->input('short_description'),
            'daycare_id' => $request->user()->daycare_id
        ]);

        $group->save();
        $group->staff()->sync($request->input('staff'));
        $group->children()->sync($request->input('children'));

        $group->staff_count = count($request->input('staff'));
        $group->children_count = count($request->input('children'));

        return response()->json(
            ['group' => $group, 'message' => __('Successfully saved group.')],
            201
        );
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

        return response()->json(compact('group'));
    }

    /**
     * Updates the group
     *
     * @param SaveGroupRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function update(SaveGroupRequest $request, $id)
    {
        $group = Group::find($id);

        if (empty($group)) {
            return abort(404);
        }
        $this->authorize('update', $group);

        $group->fill([
            'name' => $request->input('name'),
            'short_description' => $request->input('short_description'),
        ]);

        $group->staff()->sync($request->input('staff'));
        $group->children()->sync($request->input('children'));
        $group->save();

        $group->load(['children', 'staff.user']);
        return response()->json(
            ['group' => $group, 'message' => __('Successfully saved group.')],
            200
        );
    }
}
