<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AbsenceRequest extends FormRequest
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
            'absence_comment' => 'required|max:500',
        ];
    }

    public function messages()
    {
        return [
            'required' => '入力必須の項目です',
            'max'      => '500文字以内で入力してください',
        ];
    }
}
