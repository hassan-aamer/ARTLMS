<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentAnswerDegreeRequest extends FormRequest
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
            'login_degree' => 'nullable',
            'attendance_and_mission_degree' => 'nullable',
            'staging_calendars_degree' =>'nullable',
            'final_calendar_degree' =>'nullable',
            'student_final_degree' =>'nullable',
            'question_degree.*' =>'nullable',
            'calendar_final_calendar_degree'=>'nullable',
            'knowledge_side_degree'=>'nullable',
            'performance_side_degree'=>'nullable',
            'sentimental_side_degree'=>'nullable',
            
        ];

    }

    public function messages()
    {
        return [
            'login_degree.digits_between' => ' درجات تسجيل الدخول من 5 درجات',
            'attendance_and_mission_degree.digits_between' => ' درجات الحضور والتكليفات من 20 درجة',
            'staging_calendars_degree.digits_between' => ' درجات التقويمات المرحلية من 25 درجة',
        ];
    }



}
