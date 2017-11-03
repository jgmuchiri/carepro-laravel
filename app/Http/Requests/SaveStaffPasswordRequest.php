<?php

namespace App\Http\Requests;

use App\Models\Addresses\Address;
use App\Models\Subscriptions\Plan;
use App\Models\Staff;
use Illuminate\Foundation\Http\FormRequest;

class SaveStaffPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['password' => 'required|min:6|confirmed'];
    }
}
