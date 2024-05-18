<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalendarQuestionRequest extends FormRequest
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
            'calendar_id' => 'required',
            'question_kind' => 'required|in:theoretical,practical',
            'title' => 'nullable|max:255',
            'description'=>'nullable',
            'question_mark' => 'required|integer',
            'question_file' => 'nullable',
            'question_file_ext' => 'nullable',
            'question_type' => 'nullable|in:true_false,single_choice,multiple_choice,article,complete,connect,rearrange',
            'question_photopia' => 'nullable',
            'status' => 'nullable|in:yes,no',
            'sort' => 'nullable|integer|min:0',
            'choice_text.*' =>'nullable',
            'correct_answer.*' =>'nullable',
            'correct_answer_correct.*' =>'nullable',
            'choice_file.*' =>'nullable',
            'descriptions.*' =>'nullable',
            'choice_file_ext.*' =>'nullable',
            'choice_video.*' =>'nullable',

        ];

    }

    public function messages()
    {
        return [
            'calendar_id.required' => 'التقويم مطلوب',
            'question_kind.required' =>'النوع  مطلوب نظري أو عملي',
            'question_kind.in' =>'النوع  مطلوب نظري أو عملي',
            'title.required' => ' العنوان مطلوب ',
            'title.max' => ' يجب عدد الحروف أقل من 256 حرف ',
            'question_mark.required' => 'درجة السؤال مطلوبة',
            'question_mark.integer' => 'درجة السؤال يجب أن تكون رقم صحيح',

            'question_type.in' =>'نوع السؤال يجب  أن يكون من ضمن الاختيارات ',
            'status.in' =>'يجب أن تكون الحالة yes or no',
            'sort.integer' =>'يجب أن يكون ترتيب العنصر رقم صحيح',
            'sort.min' =>'يجب أن يكون ترتيب العنصر أكبر من أو يساوي 0',
        ];
    }



}
