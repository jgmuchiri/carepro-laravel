<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Child;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class AttendanceController extends Controller
{
    public function toggleCheckIn(Request $request, $id)
    {
        $child = Child::with([
            'pickupUsers',
            'parents',
            'attendance' => function ($query) {
                $query->onlyLastRecord();
            }
        ])->findOrFail($id);

        $this->authorize('update', $child);

        $pickup_parent = null;
        $pickup_user = null;
        $pin = $request->input('pin');
        foreach ($child->parents as $parent) {
            if ($parent->pin == $pin) {
                $pickup_parent = $parent;
                break;
            }
        }

        if ($pickup_parent == null) {
            foreach ($child->pickupUsers as $current_pickup_user) {
                if ($current_pickup_user->pin == $pin) {
                    $pickup_user = $current_pickup_user;
                }
            }
        }

        if ($pickup_user == null && $pickup_parent == null) {
            return response()->json(new MessageBag(['pin' => __('Pin does not match user.')]), 422);
        }

        $attendance = null;
        if ($child->is_checked_in) {
            $attendance = $child->attendance->first();
            $attendance->check_out_date = Carbon::now();
            if ($pickup_user != null) {
                $attendance->checkOutPickupUser()->associate($pickup_user);
            } else {
                $attendance->checkOutParent()->associate($parent);
            }
        } else {
            $attendance = new Attendance(['check_in_date' => Carbon::now()]);
            $attendance->child()->associate($child);
            if ($pickup_user != null) {
                $attendance->checkInPickupUser()->associate($pickup_user);
            } else {
                $attendance->checkInParent()->associate($parent);
            }
        }

        $attendance->save();

        return response()->json(['message' => 'Successfully toggled check in status']);
    }
}
