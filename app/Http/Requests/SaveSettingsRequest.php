<?php

namespace App\Http\Requests;

use App\Models\Addresses\Address;
use Illuminate\Foundation\Http\FormRequest;

class SaveSettingsRequest extends FormRequest
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
            'number_of_children_allowed' => 'required|numeric',
            'number_of_staff_allowed*' => 'required|numeric'
        ];
    }
}
