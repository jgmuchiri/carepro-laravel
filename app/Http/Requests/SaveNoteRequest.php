<?php

namespace App\Http\Requests;

use App\Models\Child;
use App\Models\Permissions\Role;
use App\Models\Subscriptions\Plan;
use App\Models\ChildParent;
use Illuminate\Foundation\Http\FormRequest;

class SaveNoteRequest extends FormRequest
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
            'title' => 'required|max:255|string',
            'body' => 'required|string',
            'witnesses' => 'max:8000|string|nullable',
            'action_taken' => 'string|nullable',
            'remarks' => 'string|nullable',
            'location' => 'string|nullable|max:255',
            'incident_type' => 'string|nullable|max:255',
            'photo_uris.*' => 'image|max:5000',
        ];
    }
}
