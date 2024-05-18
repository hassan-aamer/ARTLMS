<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZoomRequest extends FormRequest
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
            'teacher_id' =>'nullable',
            'level_id' => 'required',
            'section_id' => 'required',
            'title' => 'required|max:255',
            'start_time' => 'required|after:now',
            'duration' => 'required|integer',
            'end_time' =>'nullable',
            'join_url' =>'nullable',
            'meeting_id' => 'nullable',
            'start_url' => 'nullable',
            'host_id' => 'nullable',
            'password' => 'nullable',
        ];

    }

    public function messages()
    {
        return [
            'level_id.required' => ' حدد الصف الدراسي أولاً',
            'title.required' => ' العنوان مطلوب ',
            'title.max' => ' يجب عدد الحروف أقل من 256 حرف ',
            'start_time.required' => ' وقت الجلسة مطلوب ',
            'start_time.after' => ' يجب أن يكون وقت الجلسة بعد الآن ',
            'start_time.date_format' => ' صيغة الوقت والتاريخ غير صحيحة ',
            'duration.required' => ' المدة مطلوبة ',
            'duration.integer' => 'المدة يجب أن تكون عدد دقائق',

        ];
    }



}
