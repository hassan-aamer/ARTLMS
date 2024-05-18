<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillRequest extends FormRequest
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
        $images = request()->isMethod('put') ? 'nullable|mimes:png,jpg,jpeg,webp,svg,gif|max:2000' : 'required|mimes:png,jpg,jpeg,webp,svg,gif|max:2000';

        return [
            'teacher_id' => 'nullable',
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'nullable|in:yes,no',
            'sort' => 'nullable|integer|min:0',
            'meta_description' => 'nullable',
            'knowledge_desc' =>'nullable',
            'performance_desc' =>'nullable',
            'sentimental_desc' =>'nullable',
            'keywords' => 'nullable',
            'video_link' => 'nullable|url',
            'images.*' =>$images,
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
            'video_link.url' =>'يجب أن يكون الفيديو رابط https...',
            'images.*.required' =>'الصورة مطلوبة',
            'images.*.mimes' =>'يجب أن تكون صيغة الصورة (png - jpg - jpeg - webp - svg - gif) ',
            'images.*.max' =>'يجب أن لا تتعدي حجم الصورة 2 ميجا بايت',
        ];
    }



}
