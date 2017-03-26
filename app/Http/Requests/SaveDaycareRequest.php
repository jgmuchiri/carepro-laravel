<?php

namespace App\Http\Requests;

use App\Models\Addresses\Address;
use Illuminate\Foundation\Http\FormRequest;

class SaveDaycareRequest extends FormRequest
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
                'employee_tax_identifier' => 'required|max:255'
            ],
            Address::getRules()
        );
    }
}
