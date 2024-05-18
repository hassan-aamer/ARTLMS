<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
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
        $schedule_id = request()->get('kind') === 'connected' ? 'nullable' : 'required';
        $unit_id = request()->get('kind') === 'connected' ? 'required' : 'nullable';
        return [
            'teacher_id' => 'nullable',
            'category_id' => 'required',
            'unit_id' => $unit_id,
            'schedule_id' => $schedule_id,
            'gallery_id' => 'nullable',
            'kind' => 'required|max:255' ,
            'title' => 'required|max:255',
            'short_description' => 'required',
            'image' =>$image ,
            'type' => 'required|in:lesson,lecture',
            'results' => 'nullable',
            'term' => 'required',
            'video_link' => 'nullable',
            'video_link2' => 'nullable',
            'status' => 'nullable|in:yes,no',
            'sort' => 'nullable|integer|min:0',
            'meta_description' => 'nullable',
            'keywords' => 'nullable',
            'name.*' =>$name,
            'file_type.*' =>$file_type,
            'descriptions.*' =>'nullable',
            'file_uploaded.*' =>$file_uploaded,
            'skills.*' => 'required',
        ];

    }

    public function messages()
    {
        return [
            'unit_id.required' => ' حدد الوحدة أولاً',
            'schedule_id.required' => ' حدد المقرر أولاً',
            'category_id.required' => ' حدد المجال أولاً',
            'title.required' => ' العنوان مطلوب ',
            'title.max' => ' يجب عدد الحروف أقل من 256 حرف ',
            'short_description.required' => ' الوصف المختصر مطلوب',
            'image.required' =>'الصورة مطلوبة',
            'image.mimes' =>'يجب أن تكون صيغة الصورة (png - jpg - jpeg - webp - svg - gif) ',
            'image.max' =>'يجب أن لا تتعدي حجم الصورة 2 ميجا بايت',
            'type.required' =>'النوع مطلوب',
            'type.in' =>'يجب أن يكون النوع درس أو محاضرة',
            'status.in' =>'يجب أن تكون الحالة yes or no',
            'term.required' =>'يجب اختيار الفصل الدراسي',
            'sort.integer' =>'يجب أن يكون ترتيب العنصر رقم صحيح',
            'sort.min' =>'يجب أن يكون ترتيب العنصر أكبر من أو يساوي 0',
            'name.*.required' => ' الاسم مطلوب ',
            'name.*.max' => ' يجب عدد الحروف أقل من 256 حرف ',
            'file_type.*.required' => ' نوع الملف مطلوب ',
            'file_type.*.max' => ' يجب عدد الحروف أقل من 256 حرف ',
            'file_uploaded.*.required' =>'الملف مطلوب',
            'file_uploaded.*.max' =>'يجب أن لا يتعدي حجم الملف 10 ميجا بايت',
            'skills.*' => 'يجب اختيار مهارات الدرس'
        ];
    }



}
