<?php

namespace App\Http\Requests;

use App\Models\Addresses\Address;
use App\Models\Child;
use App\Models\Permissions\Role;
use Illuminate\Foundation\Http\FormRequest;

class SaveGroupRequest extends FormRequest
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
        return [
            'name' => 'required|max:255',
            'description' => 'required|max:500',
            'children.*' => 'required|exists:children,id',
            'staff.*' => 'required|exists:staff,id'
        ];
    }
}
