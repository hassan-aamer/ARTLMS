<?php

namespace App\Http\Requests;

use App\Models\Term;
use Illuminate\Foundation\Http\FormRequest;

class TermRequest extends FormRequest
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
        $term = Term::find((int) request()->segment(3));
        $name = request()->isMethod('put') ? 'required|unique:terms,name,'.$term->id.',id' : 'required|max:255|unique:terms';
        return [
            'teacher_id' => 'nullable',
            'name' => $name,
        ];

    }

    public function messages()
    {
        return [
            'name.required' => ' الاسم مطلوب ',
            'name.max' => ' يجب عدد الحروف أقل من 256 حرف ',
        ];
    }



}
