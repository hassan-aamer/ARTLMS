<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExtensionRequest extends FormRequest
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
            'teacher_id' => 'nullable',
            'file_type' => 'required|max:255',
            'file_ext' => 'required|max:255',
        ];

    }

    public function messages()
    {
        return [
            'file_type.required' => ' نوع الملف  مطلوب ',
            'file_type.max' => ' يجب عدد الحروف أقل من 256 حرف ',
            'file_ext.required' => ' امتداد الملف مطلوب ',
            'file_ext.max' => ' يجب عدد الحروف أقل من 256 حرف ',
        ];
    }



}
