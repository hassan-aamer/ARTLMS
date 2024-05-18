<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'level_id' => 'required',
            'group' => 'required|in:t,d',
            'video_link' => 'nullable',
            'teacher_id' => 'nullable',
            'category_id' => 'nullable',
            'tags_id' => 'nullable',
            'title' => 'required|max:255',
            'description' => 'required',
            'image' =>$image ,
            'status' => 'nullable|in:yes,no',
            'sort' => 'nullable|integer|min:0',
            'name.*' =>'nullable|max:255',
            'file_type.*' =>'nullable|max:255',
            'descriptions.*' =>'nullable',
            'file_uploaded.*' =>'nullable|max:10000',
            'meta_description' => 'nullable',
            'keywords' => 'nullable',
        ];

    }

    public function messages()
    {
        return [
            'level_id.required' => ' اختر الفصل الدراسي  ',
            'group.required' => ' اختر المجموعة من فضلك ',
            'group.in' => ' يجب أن تكون المجموعه تجريبية أو ضابطة ',
            'title.required' => ' الاسم مطلوب ',
            'title.max' => ' يجب عدد الحروف أقل من 256 حرف ',
            'description.required' => '  الوصف مطلوب',
            'image.required' =>'الصورة مطلوبة',
            'image.mimes' =>'يجب أن تكون صيغة الصورة (png - jpg - jpeg - webp - svg - gif) ',
            'image.max' =>'يجب أن لا تتعدي حجم الصورة 2 ميجا بايت',
            'status.in' =>'يجب أن تكون الحالة yes or no',
            'sort.integer' =>'يجب أن يكون ترتيب العنصر رقم صحيح',
            'sort.min' =>'يجب أن يكون ترتيب العنصر أكبر من أو يساوي 0',
        ];
    }



}
