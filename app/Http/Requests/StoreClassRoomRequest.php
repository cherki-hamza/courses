<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'List_Classes.*.name_class_ar' => 'required',
            'List_Classes.*.name_class_en' => 'required',
            'List_Classes.*.grade_id'      => 'required',
        ];
    }


    public function messages()
    {
        return [
            'List_Classes.*.name_class_ar.required' => 'The Arabic name class is required',
            'List_Classes.*.name_class_en.required' => 'The English name class is required',
            'List_Classes.*.grade_id.required'      => 'The grade name is required',
        ];
    }
}
