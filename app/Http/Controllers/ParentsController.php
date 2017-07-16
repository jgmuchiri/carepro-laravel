<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveAssignChildrenRequest;
use App\Http\Requests\SaveParentRequest;
use App\Models\Addresses\Address;
use App\Models\Child;
use App\Models\ChildParent;
use App\Models\Permissions\Role;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\User;
use Storage;

class ParentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('create', ChildParent::class);
        $parents = ChildParent::whereDaycareId($request->user()->daycare_id)->get();

        return view('parents.index')->with(compact('parents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', ChildParent::class);
        $parent = new ChildParent();
        $route = 'parents.store';
        return view('parents.create-edit')->with(compact('parent','route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Requests\SaveParentRequest $request
     */
    public function store(SaveParentRequest $request)
    {
        $this->authorize('store', ChildParent::class);
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

        $photo_uri = Storage::disk('public')->putFile('parent-images', $request->file('photo_uri'), 'public');
        $parent = new ChildParent([
            'photo_uri' => $photo_uri,
            'date_of_birth' => $request->input('dob'),
            'pin' => $request->input('pin'),
            'is_primary' => $request->has('is_primary')
        ]);
        $user->parent()->save($parent);

        $role = Role::whereName(Role::PARENT_ROLE)->first();
        $user->roles()->sync([$role->id]);

        MailService::sendConfirmationEmail($user);

        return redirect()->route('parents.index')
            ->with(['successes' => new MessageBag([__('Successfully created parent.')])]);
    }

    /**
     * Shows parent
     *
     * @param Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $parent = ChildParent::findOrFail($id);
        $this->authorize('show', $parent);

        $children = Child::whereDaycareId($request->user()->daycare->id)->get();
        $user = $request->user();

        return view('parents.show')->with(compact('children', 'parent', 'user'));
    }

    /**
     * Updates a parents children
     *
     * @param Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignChildren(SaveAssignChildrenRequest $request, $id)
    {
        $parent = ChildParent::findOrFail($id);
        $this->authorize('update', $parent);

        if (!$request->has('children')) {
            return redirect()->route('parents.show', $id)
                ->withErrors(__('A child must be selected.'));
        }
        $parent->children()->sync($request->input('children', []));

        return redirect()->route('parents.show', $id)
            ->with(['successes' => new MessageBag([__('Successfully saved parent.')])]);
    }
}
