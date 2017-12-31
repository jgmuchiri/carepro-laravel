<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveStaffRequest;
use App\Http\Requests\SaveStaffPasswordRequest;
use App\Models\Addresses\Address;
use App\Models\Staff;
use App\Models\Permissions\Role;
use App\Services\MailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Storage;
use App\User;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $staff = Staff::whereDaycareId($request->user()->daycare_id)
            ->with(['user.address'])
            ->get();

        $can_create_staff = $request->user()->can('create', Staff::class);

        return response()->json(compact('staff', 'can_create_staff'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveStaffRequest $request)
    {
        $this->authorize('store', Staff::class);

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'confirmation_code' => str_random(30)
        ]);

        $address = Address::createFromRawInput($request->input());
        $user->address()->associate($address);
        $user->daycare()->associate($request->user()->daycare_id);

        $user->save();

        $photo_uri = Storage::disk('public')->putFile('staff-images', $request->file('photo_uri'), 'public');
        $staff = new Staff(['photo_uri' => $photo_uri, 'date_of_birth' => $request->input('dob')]);
        $user->staff()->save($staff);

        $role = Role::whereName(Role::STAFF_ROLE)->first();
        $user->roles()->sync([$role->id]);

        MailService::sendConfirmationEmail($user);

        $staff->load('user.address');
        return response()->json(
            ['staff_member' => $staff, 'message' => __('Successfully created staff member.')],
            201
        );
    }

    /**
     * Returns edit data for a staff member
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $staff = Staff::with([
            'user.address.city',
            'user.address.state',
            'user.address.zipCode',
            'user.address.country',
            'groups'
        ])->find($id);

        if (empty($staff)) {
            return abort(404);
        }

        $this->authorize('edit', $staff);

        return response()->json(['staff' => $staff]);
    }

    /**
     * Updates a staff member
     *
     * @param int $id
     * @param SaveStaffRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $staff = Staff::with([
            'user.address.city',
            'user.address.state',
            'user.address.zipCode',
            'user.address.country',
        ])->find($id);

        if (empty($staff)) {
            return abort(404);
        }

        $this->authorize('update', $staff);

        $staff->user->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
        $staff->user->save();

        $staff->user->address->updateFromRawInput($request->input());

        if (!empty($request->file('photo_uri'))) {
            $photo_uri = Storage::disk('public')
                ->putFile('staff-images', $request->file('photo_uri'), 'public');
            $staff->photo_uri = $photo_uri;
        }
        $staff->date_of_birth = $request->input('dob');

        $staff->save();

        return response()->json(
            ['staff_member' => $staff, 'message' => __('Successfully updated staff member.')],
            200
        );
    }

    /**
     * Updates staff password
     *
     * @param $id
     * @param SaveStaffPasswordRequest $request
     *
     * @return JsonResponse
     */
    public function updatePassword($id, SaveStaffPasswordRequest $request)
    {
        $staff = Staff::with('user')->find($id);

        if (empty($staff)) {
            return abort(404);
        }

        $this->authorize('update', $staff);
        $staff->user->password = bcrypt($request->input('password'));

        $staff->user->save();

        return response()->json(
            ['staff_member' => $staff, 'message' => __('Successfully updated staff member.')],
            200
        );
    }
}
