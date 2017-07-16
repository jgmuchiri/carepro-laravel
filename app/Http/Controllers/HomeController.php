<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Staff;
use Illuminate\Http\Request;

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
        $daycare_id = $request->user()->daycare_id;
        $children_to_activate = Child::whereDaycareId($daycare_id)->wherePendingApproval()->first();
        $daycare_id = $request->user()->daycare->id;
        $children = Child::whereDaycareId($daycare_id)->get();
        $staff = Staff::whereDaycareId($daycare_id)->with(['user'])->get();

        return view('home')->with(compact('children_to_activate', 'children', 'staff'));
    }
}
