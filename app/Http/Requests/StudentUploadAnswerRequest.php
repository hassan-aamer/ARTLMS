<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentUploadAnswerRequest extends FormRequest
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
        $file_uploaded = request()->isMethod('put') ? 'nullable|max:10000' : 'required|max:10000';
        $teacher = request()->isMethod('put') ? 'nullable' : 'required';
        return [
            'student_id' => 'nullable',
            'course_id' => 'nullable',
           // 'teacher_id' => $teacher,
            'teacher_correct_date' =>'nullable',
            'student_answer_date' =>'nullable',
            'degree' =>'nullable|in:1,2,3,4,5',
            'file_uploaded' =>$file_uploaded,
        ];

    }

    public function messages()
    {
        return [
          //  'teacher_id.required' => ' حدد المعلم أولاً',
            'degree.in' =>'يجب أن تكون الدرجة مابين [ضعيف - مقبول - جيد - جيد جدا - ممتاز]',
            'file_uploaded.required' =>'الملف مطلوب',
            'file_uploaded.max' =>'يجب أن لا يتعدي حجم الملف 10 ميجا بايت',
        ];
    }



}
