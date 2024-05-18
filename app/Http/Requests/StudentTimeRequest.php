<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentTimeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'start_time' => 'required',
            'end_time' => 'required'
        ];

    }

    public function messages()
    {
        return [
            'start_time.required' => "وقت البدء مطلوب",
            'end_time.required' => "وقت الانتهاء مطلوب"
        ];
    }
}
