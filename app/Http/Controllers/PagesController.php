<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriptions\Plan;

class PagesController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        
        return view('welcome')->with(compact('plans'));
    }
}
