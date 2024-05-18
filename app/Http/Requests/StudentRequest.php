<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StudentRequest extends FormRequest
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
        $user = User::find((int) request()->segment(3));
        $email = request()->isMethod('put') ? 'required|email|unique:users,email,'.$user->id.',id' : 'required|email|max:255|unique:users';
        $second_email = request()->isMethod('put') ? 'nullable|email|unique:users,second_email,'.$user->id.',id' : 'nullable|max:255|email|unique:users';
        $password = request()->isMethod('put') ? '' : 'required|min:8|confirmed';

        return [
            'name' => 'required|max:255',
            'email' => $email,
            'phone' => 'required|min:0',
            'group_type' => 'required|in:d,t',
            'password' => $password,
            'second_email' => $second_email,
            'date_of_birth' => 'nullable',
            'company' => 'nullable',
            'job_title' => 'nullable',
            'gender' => 'nullable|in:male,female',
            'email_verified_at' =>'nullable',
            'national_id'=>'nullable',
            'city'=>'nullable',
            'specialist' =>'nullable',
            'qualification'=>'nullable',
            'school_or_college'=>'nullable',
            'department'=>'nullable',
            'reason'=>'nullable',
            'status'=>'nullable|in:yes,no',
            'image'=>'nullable|mimes:png,jpg,jpeg,webp,svg,gif|max:2000',
            'level_id'=>'nullable',
            'section_id'=>'nullable',

        ];

    }

    public function messages()
    {
        return [
            'name.required' => ' الاسم مطلوب ',
            'name.max' => ' يجب عدد حروف الاسم أقل من 256 حرف ',
            'email.required' => ' البريد الإلكتروني مطلوب ',
            'email.max' => ' يجب عدد حروف البريد الإلكتروني أقل من 256 حرف ',
            'email.email' => ' صيغة البريد الإلكتروني خاطئة ',
            'email.unique' => '  البريد الإلكتروني موجود من قبل ',
            'phone.required' => ' رقم الهاتف مطلوب  ',
            'group_type.required' => ' حقل المجموعة مطلوب  ',
            'group_type.in' => ' حقل المجموعة يجب ان يكون ضابطة او  تجريبية  ',
            'password.required' => ' حقل كلمة المرور مطلوب ',
            'password.min' => ' يجب عدد حروف كلمة المرور أكثر من أو يساوي 8 أحرف ',
            'password.confirmed' => ' كلمة المرور غير متطابقة ',
            'second_email.max' => ' يجب عدد الحروف أقل من 256 حرف ',
            'second_email.email' => ' صيغة البريد الإلكتروني البديل خاطئة ',
            'second_email.unique' => '  البريد الإلكتروني البديل موجود من قبل ',
            'image.mimes' =>'يجب أن تكون صيغة الصورة (png - jpg - jpeg - webp - svg - gif) ',
            'image.max' =>'يجب أن لا تتعدي حجم الصورة 2 ميجا بايت',
        ];
    }



}
