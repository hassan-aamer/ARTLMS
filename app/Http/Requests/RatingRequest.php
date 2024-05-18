<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RatingRequest extends FormRequest
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
            'student_id' => 'nullable',
            'course_id' => 'nullable',
            'rating' =>'required|in:1,2,3,4,5',
            'comment' =>'required',
        ];

    }

    public function messages()
    {
        return [
            'rating.required' =>'الدرجة مطلوبة',
            'rating.in' =>'الدرجة يجب أن تكون احد الاختيارات الموجودة',
            'comment.required' =>'التعليق مطلوب',

        ];
    }



}
