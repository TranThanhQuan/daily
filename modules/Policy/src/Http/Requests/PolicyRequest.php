<?php

namespace Modules\Policy\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PolicyRequest extends FormRequest
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
            'content' => 'required|min:1',
            // 'file' => 'bail|required|image|mimes:jpeg,png|mimetypes:image/jpeg,image/png|extensions:jpg,png|max:2048',
        ];

       
        return $rules;
    }

    public function messages(){
        return [
            'min' => __('policy::validation.min'),
        ];
    }

    public function attributes(){
        return [
            'name' => __('policy::validation.attributes.name'),
            'email' => __('policy::validation.attributes.email'),
            'password' => __('policy::validation.attributes.password'),
            'group_id' => __('policy::validation.attributes.group_id')
        ];
    }

    // public function failedValidation(ValidatorContract $validator)
    // {
    //     $errors = (new ValidationException($validator))->errors();

    //     foreach ($errors as $key => $value) {
    //         $errors[$key] = reset($value);
    //     }

    //     $requests = [
    //         "error"  => [
    //             'message' => $errors['file'] ?? ''
    //         ],
    //     ];
    //     throw new HttpResponseException(response()->json($requests, JsonResponse::HTTP_BAD_REQUEST));
    // }
}
