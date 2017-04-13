<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveRolesRequest;
use App\Models\Permissions\Permission;
use App\Models\Permissions\Role;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request;
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('edit', Role::class);
        $roles = Role::whereUserCanEdit($request->user())->get();

        return view('roles.index')->with(compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Role::class);
        $role = new Role();
        $permissions = Permission::whereIsNotAdminOnly()->get();
        $route = 'roles.store';
        return view('roles.create-edit')->with(compact('role', 'permissions', 'route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SaveRolesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveRolesRequest $request)
    {
        $this->authorize('store', Role::class);
        $role = Role::create([
            'name' => $request->input('name'),
            'is_user_editable' => true
        ]);

        $role->daycare()->associate($request->user()->daycare);
        $role->permissions()->sync($request->input('permissions'));

        $role->save();

        return redirect()->route('roles.edit', $role->id)
            ->with(['successes' => new MessageBag(['Successfully created role.'])]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        if (empty($role)) {
            return abort(404);
        }
        $this->authorize('update', $role);

        $permissions = Permission::whereIsNotAdminOnly()->get();
        $route = 'roles.update';


        return view('roles.create-edit')->with(compact('role', 'permissions', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SaveRolesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveRolesRequest $request, $id)
    {
        $role = Role::find($id);

        if (empty($role)) {
            return abort(404);
        }
        $this->authorize('update', $role);

        $role->name = $request->input('name');
        $role->permissions()->sync($request->input('permissions'));
        $role->save();

        return redirect()->route('roles.edit', $role->id)
            ->with(['successes' => new MessageBag(['Successfully created role.'])]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);

        if (empty($role)) {
            return abort(404);
        }

        $this->authorize('delete', $role);

        $role->delete();

        return redirect()->back()->with(['successes' => new MessageBag(['Successfully deleted role'])]);
    }
}
