<?php

namespace App\Http\Controllers;

use App\Models\Addresses\Country;
use Illuminate\Http\Request;

class AddressesController extends Controller
{
    /**
     * Returns all countries
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function countriesIndex()
    {
        return response()->json(['countries' => Country::all()]);
    }
}
