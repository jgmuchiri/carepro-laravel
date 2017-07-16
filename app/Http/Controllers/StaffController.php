<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveStaffRequest;
use App\Models\Addresses\Address;
use App\Models\Staff;
use App\Models\Permissions\Role;
use App\Services\MailService;
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
        $staff = Staff::whereDaycareId($request->user()->daycare_id)->get();

        return view('staff.index')->with(compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Staff::class);
        $staff = new Staff();
        $route = 'staff.store';
        return view('staff.create-edit')->with(compact('staff','route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Requests\SaveStaffRequest $request
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

        return redirect()->route('staff.index')
            ->with(['successes' => new MessageBag([__('Successfully created staff member.')])]);
    }
}
