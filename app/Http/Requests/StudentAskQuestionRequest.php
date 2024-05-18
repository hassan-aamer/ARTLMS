<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentAskQuestionRequest extends FormRequest
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
        $teacher = request()->isMethod('put') ? 'nullable' : 'required';
        $question = request()->isMethod('put') ? 'nullable' : 'required';

        return [
            'student_id' => 'nullable',
            'course_id' => 'nullable',
         //   'teacher_id' => $teacher,
            'question' =>$teacher,
            'answer' =>'nullable',
        ];

    }

    public function messages()
    {
        return [
          //  'teacher_id.required' => ' حدد المعلم أولاً',
            'question.required' =>'السؤال مطلوب',
        ];
    }



}
