<?php

namespace App\Http\Requests;

use App\Models\Child;
use App\Models\Permissions\Role;
use App\Models\Subscriptions\Plan;
use App\Models\ChildParent;
use Illuminate\Foundation\Http\FormRequest;

class SaveChildRequest extends FormRequest
{
    protected $hasParents;

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
        $parents = ChildParent::whereDaycareId($this->user()->daycare_id)->get();
        $this->hasParents = count($parents) > 0;

        $rules = [];
        if ($this->user()->role->name != Role::PARENT_ROLE) {
            $rules = [
                'parents' => $this->hasParents ? 'required' : 'bail|required',
                'parents.*' => 'required|exists:parents,id',
                'status' => 'required|exists:statuses,id'
            ];
        }

        $rules = array_merge(
            $rules,
            [
                'name' => 'required|max:255',
                'nickname' => 'max:50',
                'ssn' => 'required|max:10',
                'dob' => 'required|date|before:today',
                'photo_uri' => 'required|image|max:5000',
                'gender' => 'required|exists:genders,id',
                'blood_type' => 'nullable|exists:blood_types,id',
                'pin' => 'required|numeric',
                'religion' => 'nullable|exists:religions,id',
                'ethnicity' => 'nullable|exists:ethnicities,id',
            ]
        );

        return $rules;
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
            $child_count = Child::whereDaycareId($daycare->id)->count();
            if ($daycare->onGenericTrial() && !$daycare->subscribed('main') && $child_count > 9) {
                $validator->errors()->add('generic', __('This daycare is at the max number of children for its plan. Please ask the daycare to upgrade their account.'));
            }

            if ($daycare->subscribed('main')) {
                $plan = Plan::whereName($daycare->subscription('main')->stripe_plan)->first();
                if ($child_count >= $plan->number_of_children_allowed) {
                    $validator->errors()->add('generic', __('This daycare is at the max number of children for its plan. Please ask the daycare to upgrade their account.'));
                }
            }
        });
    }

    /**
     * Gets the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        if ($this->hasParents) {
            return [];
        }

        return [
            'parents.required' =>
                __('A child can not be registered without a parent. Please register parent(s) first before registering your first child.')
        ];
    }
}
