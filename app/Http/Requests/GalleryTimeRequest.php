<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryTimeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'gallery_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ];

    }

    public function messages()
    {
        return [
            'gallery_id.required' => "يجب تحديد المعرض المطلوب",
            'start_time.required' => "وقت البدء مطلوب",
            'end_time.required' => "وقت الانتهاء مطلوب"
        ];
    }
}
