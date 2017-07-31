<?php

namespace App\Http\Requests;

use App\Models\Addresses\Address;
use App\Models\Subscriptions\Plan;
use App\Models\Staff;
use Illuminate\Foundation\Http\FormRequest;

class SaveStaffRequest extends FormRequest
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
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6|confirmed',
                'dob' => 'required|date|before:today',
                'photo_uri' => 'required|image|max:5000'
            ],
            Address::getRules()
        );
    }

    /**
     * Adds extra validation after input is validated
     *
     * @param $validator
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $daycare = $this->user()->daycare;
            $owner = $daycare->owner;
            $staff_count = Staff::whereDaycareId($daycare->id)->count();
            if ($owner->onGenericTrial() && !$owner->subscribed('main') && $staff_count > 9)
            {
                $validator->errors()->add('generic', __('This daycare is at the max number of staff for its plan. Please ask the owner to upgrade their account.'));
            }
            if ($owner->subscribed('main')) {
                $plan = Plan::whereName($owner->subscription('main')->stripe_plan)->first();
                if ($staff_count >= $plan->number_of_staff_allowed) {
                    $validator->errors()->add('generic', __('This daycare is at the max number of staff for its plan. Please ask the owner to upgrade their account.'));
                }
            }

        });
    }
}
