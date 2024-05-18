<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuideRequest extends FormRequest
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
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'nullable|in:yes,no',
            'sort' => 'nullable|integer|min:0',
            'meta_description' => 'nullable',
            'keywords' => 'nullable',
            'video_link' => 'nullable|url'
        ];

    }

    public function messages()
    {
        return [
            'title.required' => ' العنوان مطلوب ',
            'title.max' => ' يجب عدد الحروف أقل من 256 حرف ',
            'description.required' => 'الوصف الكامل مطلوب',
            'status.in' =>'يجب أن تكون الحالة yes or no',
            'sort.integer' =>'يجب أن يكون ترتيب العنصر رقم صحيح',
            'sort.min' =>'يجب أن يكون ترتيب العنصر أكبر من أو يساوي 0',
            'video_link.url' =>'يجب أن يكون الفيديو رابط https...'
        ];
    }



}
