<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MeetRequest extends FormRequest
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
            'sender_id' =>'nullable',
            'receiver_ids' =>'required',
            'title' => 'required|max:255',
            'start_date_time' => 'required|after:now',
            'google_meet_url' => 'required',
        ];

    }

    public function messages()
    {
        return [
            'receiver_ids.required' => ' اختر المعلمين أولاً',
            'title.required' => ' العنوان مطلوب ',
            'title.max' => ' يجب عدد الحروف أقل من 256 حرف ',
            'start_date_time.required' => 'من فضلك اختر التاريخ والوقت ',
            'start_date_time.after' => ' يجب أن يكون التاريخ والوقت في معاد قادم وليس سابق ',
            'google_meet_url.required' => 'من فضلك ادخل رابط الاجتماع ',

        ];
    }



}
