<?php

namespace Modules\Report\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
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
            'start_date' => 'required',
            'end_date' => 'required',
            'agent' => ['required', function($attribute, $value, $fail){
                            if($value ==0){
                                $fail(__('payments::validation.select'));
                            }
                        }],
        ];
        return $rules;
    }

    public function messages(){
        return [
            'required' => __('payments::validation.required'),
        ];
    }

    public function attributes(){
        return [
            'agent' => __('payments::validation.attributes.agent'),
            'start_date' => __('payments::validation.attributes.start_date'),
            'end_date' => __('payments::validation.attributes.end_date'),
        ];
    }

}
