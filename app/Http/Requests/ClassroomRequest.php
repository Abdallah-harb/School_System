<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomRequest extends FormRequest
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
            'List_Classes.*.class_name' => 'required|unique:classrooms,class_name->ar'.$this->id,
            'List_Classes.*.class_name_en' => 'required|unique:classrooms,class_name->en'.$this->id,
            'List_Classes.*.grade_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'List_Classes.*.class_name.required' => trans('messages.required_class_name'),
            'List_Classes.*.class_name_en.required' => trans('messages.required_class_name_en'),
            'List_Classes.*.class_name.unique' => trans('messages.unique_class_name'),
            'List_Classes.*.class_name_en.unique' => trans('messages.unique_class_name_en'),
        ];
    }
}
