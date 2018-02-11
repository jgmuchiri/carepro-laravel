<?php

namespace App\Http\Requests;

use App\Models\Addresses\Address;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;

class UpdateParentRequest extends FormRequest
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
        return array_merge(
            [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|',Rule::unique('users')->ignore(Auth::user()->id),
                'dob' => 'required|date|before:today',
                'photo_uri' => 'image|max:5000',
                'pin' => 'required|max:50'
            ],
            Address::getRules()
        );
    }
}
