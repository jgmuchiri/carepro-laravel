<?php

namespace App\Http\Requests;

use App\Models\Addresses\Address;
use App\Models\Child;
use App\Models\Permissions\Role;
use Illuminate\Foundation\Http\FormRequest;

class SaveAssignChildrenRequest extends FormRequest
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
            'children.*' => 'required|exists:children,id'
        ];
    }
}
