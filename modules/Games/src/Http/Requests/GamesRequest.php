<?php

namespace Modules\Games\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GamesRequest extends FormRequest
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
            'name' => 'required|max:255|unique:games,name',

        ];

       
        return $rules;
    }

    public function messages(){
        return [
            'required' => __('games::validation.required'),
            'unique' => __('games::validation.unique'),
            'max' => __('games::validation.max'),
        ];
    }

    public function attributes(){
        return [
            'name' => __('games::validation.attributes.name'),
        ];
    }
}
