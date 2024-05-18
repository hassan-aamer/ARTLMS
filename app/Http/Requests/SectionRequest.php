<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
        $image = request()->isMethod('put') ? 'nullable|mimes:png,jpg,jpeg,webp,svg,gif|max:2000' : 'required|mimes:png,jpg,jpeg,webp,svg,gif|max:2000';
        return [
            'teacher_id' => 'nullable',
            'name' => 'required|max:255',
        ];

    }

    public function messages()
    {
        return [
            'name.required' => ' الاسم مطلوب ',
            'name.max' => ' يجب عدد الحروف أقل من 256 حرف ',
        ];
    }



}
