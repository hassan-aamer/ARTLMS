<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {

        return [
            'email' => 'required',
            'password' => 'required',
        ];

    }

    public function messages()
    {
        return [
            'email.required' => ' البريد الإلكتروني مطلوب ',
            'password.required' => ' حقل كلمة المرور مطلوب ',
        ];
    }



}
