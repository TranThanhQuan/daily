<?php

namespace Modules\Agents\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgentRequest extends FormRequest
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
        // lấy ra param từ route (key = user)
        // nếu không có key = user thì sẽ là null
        $id = $this->route()->agent;

        $rules = [
            'name' => 'required|max:255|unique:agents,name',
            'email' => 'required|email|unique:agents,email',
            'password' => 'required|min:6',
            // 'status' => ['required','integer', function($attribute, $value, $fail){
            //     if($value !== 0 || $value !== 1){
            //         $fail(__('agents::validation.select'));
            //     }
            // }],
            'code_agent' => 'required|max:255',
            'syntax' => 'required|max:255',
            'facebook' => 'required|max:255',
            'phone' => 'required|max:255',
            'bank_account' => 'required|max:255',
            'games' => 'required',
        ];

        
        if($id){
            // nếu có id tức là request của trang edit
            // chỉnh sửa rule email
            $rules['email'] = 'required|email|unique:agents,email,'.$id ;
            $rules['name'] = 'required|max:255|unique:agents,name,'.$id ;

            //nếu có nhập password thì set rule còn không thì unset 
            if($this->password){
                $rules['password'] = 'min:6';
            }else{
                unset($rules['password']);
            }
        }
       
        return $rules;
    }

    public function messages(){
        return [
            'required' => __('agents::validation.required'),
            'email' => __('agents::validation.email'),
            'unique' => __('agents::validation.unique'),
            'min' => __('agents::validation.min'),
            'integer' => __('agents::validation.integer'),
        ];
    }

    public function attributes(){
        return [
            'name' => __('agents::validation.attributes.name'),
            'email' => __('agents::validation.attributes.email'),
            'code_agent' => __('agents::validation.attributes.code_agent'),
            'syntax' => __('agents::validation.attributes.syntax'),
            'facebook' => __('agents::validation.attributes.facebook'),
            'phone' => __('agents::validation.attributes.phone'),
            'bank_account' => __('agents::validation.attributes.bank_account'),
            'password' => __('agents::validation.attributes.password'),
            'games' => __('agents::validation.attributes.game'),
            // 'status' => __('agents::validation.attributes.status'),
        ];
    }

}
