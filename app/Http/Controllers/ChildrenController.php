<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveAssignParentsRequest;
use App\Http\Requests\SaveAssignGroupsRequest;
use App\Models\ChildParent;
use App\Http\Requests\SaveChildRequest;
use App\Models\BloodType;
use App\Models\Child;
use App\Models\Gender;
use App\Models\Ethnicity;
use App\Models\Groups\Group;
use App\Models\Permissions\Role;
use App\Models\Religion;
use App\Models\Status;
use App\Services\MailService;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Storage;

class ChildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('showGeneric', Child::class);

        $user = $request->user();
        $parents = null;
        $children = [];

        if ($user->role->name == Role::PARENT_ROLE) {
            $children = Child::whereParentId($user->id)->get();
        } else {
            if ($user->role->name != Role::STAFF_ROLE) {
                $children = Child::whereDaycareId($user->daycare_id)->with(['status'])->get();
            } else {
                $children = Child::whereAssignedStaffId($user->daycare_id)->with(['status'])->get();
            }
            $parents = ChildParent::whereDaycareId($user->daycare_id)->with('user')->get();
            $statuses = Status::all();
        }
        $blood_types = BloodType::all();
        $ethnicities = Ethnicity::all();
        $genders = Gender::all();
        $religions = Religion::all();

        return view('children.index')->with(compact([
            'children',
            'blood_types',
            'ethnicities',
            'genders',
            'religions',
            'statuses',
            'parents'
        ]));
    }

    /**
     * Shows child
     *
     * @param Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $child = Child::findOrFail($id);
        $this->authorize('show', $child);

        $parents = ChildParent::whereDaycareId($request->user()->daycare->id)->get();
        $user = $request->user();

        $groups = Group::whereDaycareId($request->user()->daycare->id)->get();

        return view('children.show')
            ->with(compact('child', 'parents', 'user', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Requests\SaveChildRequest $request
     */
    public function store(SaveChildRequest $request)
    {
        $this->authorize('store', Child::class);
        $photo_uri = Storage::disk('public')->putFile('children-images', $request->file('photo_uri'), 'public');

        if ($request->user()->role->name == Role::PARENT_ROLE) {
            $status_id = Status::whereName('Pending Approval')->first()->id;
            $parent_ids = [$request->user()->parent->id];
        } else {
            $status_id = $request->input('status');
            $parent_ids = $request->input('parents');
        }
        $child = new Child([
            'name' => $request->input('name'),
            'nickname' => $request->input('nickname', ''),
            'dob' => $request->input('dob'),
            'ssn' => $request->input('ssn'),
            'gender_id' => $request->input('gender'),
            'blood_type_id' => $request->input('blood_type'),
            'pin' => $request->input('pin'),
            'status_id' => $status_id,
            'religion_id' => $request->input('religion'),
            'ethnicity_id' => $request->input('ethnicity'),
            'photo' => $photo_uri,
            'created_by_user_id' => Auth::id(),
            'updated_by_user_id' => Auth::id()
        ]);
        $child->save();

        $child->parents()->sync($parent_ids);

        if ($request->user()->role->name == Role::PARENT_ROLE) {
            MailService::sendParentRegisteredChildEmail($request->user());
        }
        return redirect()->route('children.index')
            ->with(['successes' => new MessageBag([__('Successfully saved child.')])]);
    }

    /**
     * Activates a child
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate($id)
    {
        return $this->updateStatus($id, 'Active');
    }

    /**
     * Deactivates a child
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deactivate($id)
    {
        return $this->updateStatus($id, 'Inactive');
    }

    /**
     * Updates a children parents
     *
     * @param Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignParents(SaveAssignParentsRequest $request, $id)
    {
        $child = Child::findOrFail($id);
        $this->authorize('update', $child);

        if (!$request->has('parents')) {
            return redirect()->route('children.show', $id)
                ->withErrors(__('A parent must be selected.'));
        }
        $child->parents()->sync($request->input('parents', []));

        return redirect()->route('children.show', $id)
            ->with(['successes' => new MessageBag([__('Successfully saved child.')])]);
    }

    /**
     * Updates a child's groups
     *
     * @param Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignGroups(SaveAssignGroupsRequest $request, $id)
    {
        $child = Child::findOrFail($id);
        $this->authorize('update', $child);

        if (!$request->has('groups')) {
            return redirect()->route('children.show', $id)
                ->withErrors(__('A group must be selected.'));
        }
        $child->groups()->sync($request->input('groups', []));

        return redirect()->route('children.show', $id)
            ->with(['successes' => new MessageBag([__('Successfully saved child.')])]);
    }

    /**
     * Updates a child status
     *
     * @param int $id
     * @param string $status_name
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function updateStatus($id, $status_name)
    {
        $child = Child::find($id);
        $this->authorize('updateStatus', $child);
        $status = Status::whereName($status_name)->first();

        $child->status()->associate($status);
        $child->save();

        return redirect()->route('children.index')
            ->with(['successes' => new MessageBag([__('Successfully saved child.')])]);
    }
}
