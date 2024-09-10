<?php

namespace Modules\Payments\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentsRequest extends FormRequest
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
            'agent' => ['required', function($attribute, $value, $fail){
                            if($value ==0){
                                $fail(__('payments::validation.select'));
                            }
                        }],
            'amount' => 'required',
            'description' => 'required'

        ];

        return $rules;
    }

    public function messages(){
        return [
            'required' => __('payments::validation.required'),
            'integer' => __('payments::validation.integer'),
        ];
    }

    public function attributes(){
        return [
            'agent' => __('payments::validation.attributes.agent'),
            'start_date' => __('payments::validation.attributes.start_date'),
            'end_date' => __('payments::validation.attributes.end_date'),
            'amount' => __('payments::validation.attributes.amount'),
            'description' => __('payments::validation.attributes.description'),
            'group_id' => __('payments::validation.attributes.group_id'),
        ];
    }
}
