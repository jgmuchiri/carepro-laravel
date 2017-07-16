<?php

namespace App\Http\Controllers;

use App\Models\Permissions\Role;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        if ($user->role->name !== Role::TENANT_ROLE) {
            return abort(404);
        }

        return view('invoices.index')->with(compact('user'));
    }

    /**
     * Downloads an invoice
     *
     * @param Request $request
     * @param int $id
     *
     * @return mixed
     */
    public function download(Request $request, $id)
    {
        $user = $request->user();
        if ($user->role->name !== Role::TENANT_ROLE) {
            return abort(404);
        }

        return $user->downloadInvoice($id, [
            'vendor'  => \Config::get('app.name'),
            'product' => __('Subscription')
        ]);
    }
}
