<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ToolRequest extends FormRequest
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
        return [
            'teacher_id' => 'nullable',
            'title' => 'required|max:255',
            'downloaded_link' => 'required|url',
            'type' => 'nullable',
            'image' =>$image ,
            'status' => 'nullable|in:yes,no',
            'sort' => 'nullable|integer|min:0',
        ];

    }

    public function messages()
    {
        return [
            'title.required' => ' الاسم مطلوب ',
            'title.max' => ' يجب عدد الحروف أقل من 256 حرف ',
            'downloaded_link.required' => '  رابط التحميل مطلوب',
            'image.required' =>'الصورة مطلوبة',
            'image.mimes' =>'يجب أن تكون صيغة الصورة (png - jpg - jpeg - webp - svg - gif) ',
            'image.max' =>'يجب أن لا تتعدي حجم الصورة 2 ميجا بايت',
            'status.in' =>'يجب أن تكون الحالة yes or no',
            'sort.integer' =>'يجب أن يكون ترتيب العنصر رقم صحيح',
            'sort.min' =>'يجب أن يكون ترتيب العنصر أكبر من أو يساوي 0',
        ];
    }



}
