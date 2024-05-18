<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $images = request()->isMethod('put') ? 'nullable|mimes:png,jpg,jpeg,webp,svg,gif|max:2000' : 'required|mimes:png,jpg,jpeg,webp,svg,gif|max:2000';
        $name = request()->isMethod('put') ? 'nullable|max:255' : 'required|max:255';
        $file_type =request()->isMethod('put') ? 'nullable|max:255' : 'required|max:255';
        $file_uploaded = request()->isMethod('put') ? 'nullable|max:10000' : 'required|max:10000';
        return [
            'category_id' => 'nullable',
            'teacher_id' => 'nullable',
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'nullable|in:yes,no',
            'sort' => 'nullable|integer|min:0',
            'meta_description' => 'nullable',
            'video_link_active' => 'nullable',
            'video_link_active2' => 'nullable',
            'knowledge_desc' =>'nullable',
            'performance_desc' =>'nullable',
            'sentimental_desc' =>'nullable',
            'keywords' => 'nullable',
            'video_link' => 'nullable|url',
            'gallery_link' => 'nullable|url',
            'images.*' =>$images,
            'name.*' =>$name, // Used for multiple files component.
            'file_type.*' =>$file_type, // Used for multiple files component.
            'descriptions.*' =>'nullable', // Used for multiple files component.
            'file_uploaded.*' =>$file_uploaded, // Used for multiple files component.
            'skills.*' => 'required|distinct',
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
            'gallery_link.url' =>'يجب أن يكون المعرض رابط https...',
            'images.*.required' =>'الصورة مطلوبة',
            'images.*.mimes' =>'يجب أن تكون صيغة الصورة (png - jpg - jpeg - webp - svg - gif) ',
            'images.*.max' =>'يجب أن لا تتعدي حجم الصورة 2 ميجا بايت',
            'skills.*' => 'يجب اختيار المهارات في المعرض',
        ];
    }
}
