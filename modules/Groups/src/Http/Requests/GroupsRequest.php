<?php

namespace Modules\Groups\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {

        $rules = [
            'name' => 'required|max:255|unique:groups,name',

        ];

       
        return $rules;
    }

    public function messages(){
        return [
            'required' => __('groups::validation.required'),
            'unique' => __('groups::validation.unique'),
            'max' => __('groups::validation.max'),
        ];
    }

    public function attributes(){
        return [
            'name' => __('groups::validation.attributes.name'),
        ];
    }
}
