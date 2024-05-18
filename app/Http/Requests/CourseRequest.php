<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
        $name = request()->isMethod('put') ? 'nullable|max:255' : 'required|max:255';
        $file_type =request()->isMethod('put') ? 'nullable|max:255' : 'required|max:255';
        $file_uploaded = request()->isMethod('put') ? 'nullable|max:10000' : 'required|max:10000';
        return [
            'category_id' =>  'required_if:kind,==,separated',
            'teacher_id' => 'required_if:kind,==,separated',
            'scheduled_id' => 'required_if:kind,==,separated',
            'lesson_id' => 'required_if:kind,==,connected',
            'title' => 'required|max:255',
            'short_description' => 'required',
            'description' => 'required',
            'image' =>$image ,
            'video_link' => 'nullable|url',
            'video_link_active' => 'nullable',
            'video_link_active2' => 'nullable',
            'term' => 'required',
            'kind' => 'required|in:connected,separated',
            'status' => 'nullable|in:yes,no',
            'sort' => 'nullable|integer|min:0',
            'meta_description' => 'nullable',
            'keywords' => 'nullable',
            'skills[]' => 'required',
            'name.*' =>$name,
            'file_type.*' =>$file_type,
            'descriptions.*' =>'nullable',
            'file_uploaded.*' =>$file_uploaded,
        ];

    }

    public function messages()
    {
        return [
            'category_id.required_if' => 'المجال مطلوب',
            'scheduled_id.required_if' => 'المقرر مطلوب',
            'category_id.exists' => ' هذا المجال غير متواجد ',
            'teacher_id.required_if' => 'المعلم مطلوب',
            'teacher_id.exists' => ' هذا المعلم غير متواجد ',
            'lesson_id.required_if' => 'الدرس/المحاضرة مطلوبة',
            'lesson_id.exists' => ' هذا الدرس/المحاضرة غير متواجدة ',
            'title.required' => ' العنوان مطلوب ',
            'title.max' => ' يجب عدد الحروف أقل من 256 حرف ',
            'short_description.required' => ' الوصف المختصر مطلوب',
            'description.required' => 'الوصف الكامل مطلوب',
            'image.required' =>'الصورة مطلوبة',
            'image.mimes' =>'يجب أن تكون صيغة الصورة (png - jpg - jpeg - webp - svg - gif) ',
            'image.max' =>'يجب أن لا تتعدي حجم الصورة 2 ميجا بايت',
            'name.*.required' => ' الاسم مطلوب ',
            'name.*.max' => ' يجب عدد الحروف أقل من 256 حرف ',
            'file_type.*.required' => ' نوع الملف مطلوب ',
            'file_type.*.max' => ' يجب عدد الحروف أقل من 256 حرف ',
            'file_uploaded.*.required' =>'الملف مطلوب',
            'file_uploaded.*.max' =>'يجب أن لا يتعدي حجم الملف 10 ميجا بايت',
            'status.in' =>'يجب أن تكون الحالة yes or no',
            'kind.required' =>'يجب أن يكون النوع متصل أو منفصل',
            'kind.in' =>'يجب أن تكون الحالة منفصل أو متصل',
            'term.required' =>'الفصل الدراسي مطلوب',
            'video_link.url' =>'يجب أن يكون الفيديو رابط https...',
            'sort.integer' =>'يجب أن يكون ترتيب العنصر رقم صحيح',
            'sort.min' =>'يجب أن يكون ترتيب العنصر أكبر من أو يساوي 0',
            'skills[].required' => 'يجب تحديد المهارات المكتسبة في النشاط'
        ];
    }



}
