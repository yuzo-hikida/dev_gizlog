<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifyRequest extends FormRequest
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
            'correction_comment' => 'required|max:500',
            'date'               => 'required|before:tomorrow|exists:attendances,reporting_time',
        ];
    }

    public function messages()
    {
        return [
            'correction_comment.required' => '入力必須項目です。',
            'correction_comment.max'      => '500文字以内で入力してください。',
            'date.required'               => '選択必須項目です。',
            'date.before'                 => '今日以前の日付を選択してください。',
            'date.exists'                 => '出勤履歴がありません。'
        ];
    }
}
