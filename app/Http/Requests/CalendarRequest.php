<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalendarRequest extends FormRequest
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
        $type = request()->isMethod('put') ? 'nullable' : 'required|in:staging,final';

        return [
            'teacher_id' => 'nullable',
            'type' => $type,
            'curriculum_id' => 'required_if:type,==,final',
            'lesson_id' => 'required_if:staging_type,==,lesson',
            'course_id' => 'required_if:staging_type,==,course',
            'staging_type'=>'nullable|in:lesson,course',
            'final_type'=>'required_if:type,==,final|in:before,after',
            'title' => 'required|max:255',
            'kind' => 'required|in:theoretical,practical',
            'degree' => 'nullable',
            'duration' => 'nullable',
            'status' => 'nullable|in:yes,no',
            'sort' => 'nullable|integer|min:0',
            'skills.*' => 'required'
        ];

    }

    public function messages()
    {
        return [
            'type.required' =>'نوع التقويم مطلوب مرحلي أو نهائي',
            'type.in' =>'يجب أن يكون النوع مرحلي أو نهائي',
            'curriculum_id.required_if' => 'المنهج مطلوبة',
            'lesson_id.required_if' => 'الدرس/المحاضرة مطلوبة',
            'course_id.required_if' => 'النشاط مطلوب مطلوبة',
            'title.required' => ' العنوان مطلوب ',
            'title.max' => ' يجب عدد الحروف أقل من 256 حرف ',
            'kind.required' =>'نوع التقويم مطلوب نظري أو عملي',
            'kind.in' =>'نوع التقويم مطلوب نظري أو عملي',
            'status.in' =>'يجب أن تكون الحالة yes or no',
            'sort.integer' =>'يجب أن يكون ترتيب العنصر رقم صحيح',
            'sort.min' =>'يجب أن يكون ترتيب العنصر أكبر من أو يساوي 0',
            'skills.*' => 'يجب اختيار مهارات التقويم'
        ];
    }



}
