<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:255',
            'subject' => 'required',
            'message' => 'required',
            'spam' => 'nullable',
            'file' => 'required',
        ];

    }

    public function messages()
    {
        return [

            'name.required' => ' الاسم مطلوب ',
            'name.max' => ' يجب عدد الحروف أقل من 256 حرف ',
            'email.required' => ' البريد الإلكتروني مطلوب ',
            'email.max' => ' يجب عدد الحروف أقل من 256 حرف ',
            'phone.required' => ' الهاتف مطلوب ',
            'phone.max' => ' يجب عدد الحروف أقل من 256 حرف ',
            'subject.required' => ' الموضوع مطلوب ',
            'message.required' => ' الرسالة مطلوبة ',
        ];
    }



}
