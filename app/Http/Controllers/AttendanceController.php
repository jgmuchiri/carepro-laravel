<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Child;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Dompdf\Dompdf;

class AttendanceController extends Controller
{
    /**
     * return all attendance for child
     * @param  [int] $id [child id]
     * @return [type]     [description]
     */
    public function index(Request $request, $id)
    {
        if (!is_null($request->from)) {
            $from = \Carbon\Carbon::createFromFormat('Y-m-d', $request->from);
            $attendance = Attendance::where('child_id', $id)->with('checkOutParent', 'checkOutPickupUser')->where('created_at', '>=', $from)->latest()->get();
        } elseif (!is_null($request->to)) {
            $to = \Carbon\Carbon::createFromFormat('Y-m-d', $request->to);
            $attendance = Attendance::where('child_id', $id)->with('checkOutParent', 'checkOutPickupUser')->where('created_at', '<=', $to)->latest()->get();
        } elseif (!is_null($request->to) && !is_null($request->from)) {
            $from = \Carbon\Carbon::createFromFormat('Y-m-d', $request->from);
            $to = \Carbon\Carbon::createFromFormat('Y-m-d', $request->to);
            $attendance = Attendance::where('child_id', $id)->with('checkOutParent', 'checkOutPickupUser')->where('created_at', '<=', $to)->orWhere('created_at', '>=', $from)->latest()->get();
        } else {
            $attendance = Attendance::where('child_id', $id)->with('checkOutParent', 'checkOutPickupUser')->latest()->get();
        }

        return $attendance;
    }

    /**
    * return all attendance for child
    * @param  [int] $id [child id]
    * @return [type]     [description]
    */
    public function print(Request $request, $id)
    {
        $child = Child::find($id);
        if (!is_null($request->from)) {
            $from = \Carbon\Carbon::createFromFormat('Y-m-d', $request->from);
            $attendance = Attendance::where('child_id', $id)->with('checkOutParent', 'checkOutPickupUser')->where('created_at', '>=', $from)->latest()->get();
        } elseif (!is_null($request->to)) {
            $to = \Carbon\Carbon::createFromFormat('Y-m-d', $request->to);
            $attendance = Attendance::where('child_id', $id)->with('checkOutParent', 'checkOutPickupUser')->where('created_at', '<=', $to)->latest()->get();
        } elseif (!is_null($request->to) && !is_null($request->from)) {
            $from = \Carbon\Carbon::createFromFormat('Y-m-d', $request->from);
            $to = \Carbon\Carbon::createFromFormat('Y-m-d', $request->to);
            $attendance = Attendance::where('child_id', $id)->with('checkOutParent', 'checkOutPickupUser')->where('created_at', '<=', $to)->orWhere('created_at', '>=', $from)->latest()->get();
        } else {
            $attendance = Attendance::where('child_id', $id)->with('checkOutParent', 'checkOutPickupUser')->latest()->get();
        }

        $view = view('pdf.attendance')->withAttendance($attendance)->withChild($child);
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->set_base_path(public_path());
        $dompdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A3', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }

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
        if (!is_null($request->parent_id)) {
            foreach ($child->parents as $parent) {
                if ($parent->pin == $pin && $parent->id == $request->parent_id) {
                    $pickup_parent = $parent;
                    break;
                }
            }
        }
        if (!is_null($request->pickupuser_id)) {
            foreach ($child->pickupUsers as $current_pickup_user) {
                if ($current_pickup_user->pin == $pin && $current_pickup_user->id == $request->pickupuser_id) {
                    $pickup_user = $current_pickup_user;
                }
            }
        }

        if ($pickup_user == null && $pickup_parent == null) {
            return response()->json(new MessageBag(['message' => __('Pin does not match user.')]), 422);
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
