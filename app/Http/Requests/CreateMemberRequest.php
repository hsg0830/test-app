<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMemberRequest extends FormRequest
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
      'name' => 'required|max:20',
      'email' => 'required|email|max:100',
      'sex' => 'required|integer|min:1|max:2',
      'password' => 'required|min:8',
    ];
  }

  public function messages()
  {
    return [
      'name.required' => 'お名前を入力してください。',
      'name.max:20' => 'お名前は20文字以内で入力してください。',
      'email.required'  => 'メールアドレスをしてください。',
      'email.email'  => 'メールアドレスの形式を確認してください。',
      'email.max:100' => 'メールアドレスは100文字以内で入力してください。',
      'sex.required' => '性別を選択してください。',
      'password.required' => 'パスワードを入力してください。',
      'password.min:6' => 'パスワードをは8文字以上で入力してください。',
    ];
  }
}
