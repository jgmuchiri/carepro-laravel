<?php

namespace App\Http\Requests;

use App\Models\Child;
use App\Models\Permissions\Role;
use App\Models\Subscriptions\Plan;
use App\Models\ChildParent;
use Illuminate\Foundation\Http\FormRequest;

class UpdateChildRequest extends FormRequest
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
            'ssn' => 'required|max:10',
            'dob' => 'required|date|before:today',
            'photo_uri' => 'image|max:5000',
            'gender_id' => 'required|exists:genders,id',
            'blood_type_id' => 'required|exists:blood_types,id',
            'pin' => 'required|numeric',
            'status_id' => 'required|exists:statuses,id'
        ];
    }
}
