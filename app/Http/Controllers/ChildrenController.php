<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveAssignParentsRequest;
use App\Http\Requests\SaveAssignGroupsRequest;
use App\Http\Requests\UpdateChildRequest;
use App\Models\ChildParent;
use App\Http\Requests\SaveChildRequest;
use App\Models\BloodType;
use App\Models\Child;
use App\Models\Gender;
use App\Models\Ethnicity;
use App\Models\Groups\Group;
use App\Models\Permissions\Permission;
use App\Models\Permissions\Role;
use App\Models\Religion;
use App\Models\Status;
use App\Models\medication;
use App\Services\MailService;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\MessageBag;
use Storage;
use Image;


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
        $children = [];

        if ($user->role->name == Role::PARENT_ROLE) {
            $children = Child::whereParentId($user->id)->get();
        } else {
            if ($user->role->name != Role::STAFF_ROLE) {
                $children = Child::whereDaycareId($user->daycare_id)->with(['status'])->get();
            } else {
                $children = Child::whereAssignedStaffId($user->daycare_id)->with(['status'])->get();
            }
        }

        return response()->json(compact('children'));
    }

    /**
     * Returns data needed to create a child
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $this->authorize('showGeneric', Child::class);

        $user = $request->user();
        $parents = null;
        $is_not_parent = false;

        if ($user->role->name != Role::PARENT_ROLE) {
            $parents = ChildParent::whereDaycareId($user->daycare_id)->with('user')->get();
            $statuses = Status::all();
            $is_not_parent = true;
        }
        $blood_types = BloodType::all();
        $ethnicities = Ethnicity::all();
        $genders = Gender::all();
        $religions = Religion::all();

        return response()->json(compact([
            'blood_types',
            'ethnicities',
            'genders',
            'religions',
            'statuses',
            'parents',
            'is_not_parent'
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
        $child = Child::with([
            'status',
            'groups',
            'parents.user.address',
            'pickupUsers.relation',
            'emergencyContacts.address',
            'emergencyContacts.address.city',
            'emergencyContacts.address.state',
            'emergencyContacts.address.zipCode',
            'emergencyContacts.address.country',
            'emergencyContacts.relation',
            'healthProviders.address',
            'healthProviders.address.city',
            'healthProviders.address.state',
            'healthProviders.address.zipCode',
            'healthProviders.address.country',
            'healthProviders.role',
            'medication',
            'allergies'
        ])->findOrFail($id);
        $this->authorize('show', $child);

        $parents = ChildParent::whereDaycareId($request->user()->daycare->id)->get();
        $user = $request->user();

        $groups = Group::whereDaycareId($request->user()->daycare->id)->get();

        return response()->json(compact('child'));
    }

    /**
     * Returns data to edit a child
     *
     * @param Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, $id)
    {
        $child = Child::findorFail($id);
        $this->authorize('edit', $child);

        $blood_types = BloodType::all();
        $genders = Gender::all();
        $statuses = Status::all();
        $can_manage_children = $request->user()->role->permissions->contains(
            'name',
            Permission::MANAGE_CHILDREN
        );

        return response()->json(compact([
            'blood_types',
            'can_manage_children',
            'genders',
            'statuses'
        ]));
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

        $imagename = time().'.'.$request->photo_uri->getClientOriginalExtension();
        $originalimage = Image::make($request->photo_uri->getRealPath());
        Storage::disk('public')->put('children-images/original/'.$imagename, (string)$originalimage->stream());

        $originalimage->resize(200, 200);
        Storage::disk('public')->put('children-images/'.$imagename,(string)$originalimage->stream());

        $thumb_path = 'children-images/'.$imagename;

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
            'photo' => $thumb_path,
            'created_by_user_id' => Auth::id(),
            'updated_by_user_id' => Auth::id()
        ]);
        $child->save();

        $child->parents()->sync($parent_ids);

        if ($request->user()->role->name == Role::PARENT_ROLE) {
            MailService::sendParentRegisteredChildEmail($request->user());
        }

        return response()->json(
            ['child' => $child, 'message' => __('Successfully saved child.')],
            201
        );
    }

    /**
     * Updates a child
     *
     * @param UpdateChildRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateChildRequest $request, $id)
    {
        $child = Child::findOrFail($id);
        $status = Status::find($request->input('status_id'));

        if ($status->name == 'Active') {
            $child->status->name = 'Active';
        }

        $this->authorize('update', $child);

        $child->fill([
            'name' => $request->input('name'),
            'ssn' => $request->input('ssn'),
            'dob' => $request->input('dob'),
            'pin' => $request->input('pin'),
            'status_id' => $request->input('status_id'),
            'gender_id' => $request->input('gender_id'),
            'blood_type_id' => $request->input('blood_type_id'),
            'updated_by_user_id' => Auth::id()
        ]);

        if (!empty($request->file('photo_uri'))) {
            $imagename = time().'.'.$request->photo_uri->getClientOriginalExtension();
            $originalimage = Image::make($request->photo_uri->getRealPath());
            Storage::disk('public')->put('children-images/original/'.$imagename, (string)$originalimage->stream());

            $originalimage->resize(200, 200);
            Storage::disk('public')->put('children-images/'.$imagename,(string)$originalimage->stream());

            $child->photo = 'children-images/'.$imagename;
        }

        $child->save();
        $child->load([
            'status',
            'groups',
            'parents.user.address',
            'pickupUsers.relation'
        ]);

        return response()->json(
            ['child' => $child, 'message' => __('Successfully saved child.')]
        );
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
            return response()->json(['parents' => __('A parent must be selected.')], 422);
        }

        $child->parents()->sync($request->input('parents', []));
        $child->load('parents.user.address');

        return response()
            ->json(['parents' => $child->parents, 'message' => __('Successfully saved child.')]);
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
            return response()->json(['groups' => __('A group must be selected.')]);
        }
        $child->groups()->sync($request->input('groups', []));
        $child->load('groups');

        return response()->json([
            'groups' => $child->groups,
            'message' => __('Successfully saved child.')
        ]);
    }

    /**
     * Unassigns a child from the group
     *
     * @param int $child_id
     * @param int $group_id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function unassignGroup($child_id, $group_id)
    {
        $child = Child::findOrFail($child_id);
        $this->authorize('update', $child);

        $child->groups()->detach($group_id);
        $child->load('groups');

        return response()->json([
            'groups' => $child->groups,
            'message' => __('Successfully saved child.')
        ]);
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

        return response()->json(['message' => new MessageBag([__('Successfully saved child.')])]);
    }
}
