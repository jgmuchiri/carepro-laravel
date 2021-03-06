<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\ChildParent;
use App\Models\Staff;
use function array_key_exists;
use Carbon\Carbon;
use Illuminate\Http\Request;
use stdClass;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $daycare_id = $user->daycare_id;
        $children_to_activate = Child::whereDaycareId($daycare_id)->wherePendingApproval()->first();

        $can_register_parent = $user->can('create', ChildParent::class);
        $can_register_staff = $user->can('create', Staff::class);
        $can_register_child = $user->can('create', Child::class);
        $can_update_child_status = $user->can('updateStatus', $children_to_activate);
        $has_children_to_activate = $children_to_activate != null ? true : false;

        $parent_stats = ChildParent::getRegistrationStats($request->input('filter'));
        $children_stats = Child::getRegistrationStats($request->input('filter'));
        $staff_stats = Staff::getRegistrationStats($request->input('filter'));

        $registration_stats = compact('parent_stats', 'children_stats', 'staff_stats');

        return response()->json(compact(
            'has_children_to_activate',
            'can_register_child',
            'can_register_parent',
            'can_register_staff',
            'can_update_child_status',
            'registration_stats'
        ));
    }
}
