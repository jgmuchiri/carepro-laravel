<?php

namespace App\Http\Requests;

use App\Models\Child;
use App\Models\Permissions\Role;
use App\Models\Subscriptions\Plan;
use App\Models\ChildParent;
use Illuminate\Foundation\Http\FormRequest;

class SavePickupUserRequest extends FormRequest
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
            'name' => 'required|max:255|string',
            'email' => 'required|max:255|string|email',
            'phone' => 'required|max:20|string',
            'pin' => 'required|max:50|string',
            'photo_uri' => 'image|max:5000'
        ];
    }
}
