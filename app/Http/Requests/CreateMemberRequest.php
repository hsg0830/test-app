<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // 【追加】

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
    $member = $this->route('member'); // 【追加】ルートのパラメータにバインディングされたユーザーを取得（変更の場合のみ取得できます）

    return [
      'name' => 'required|max:20',
      'email' => [
          'required',
          'email',
          'max:100',
          // 【追加】メールアドレスはログイン情報として使われるため、重複を禁止するようにしています
          // この部分の意味は、以下になります。
          // 「 members テーブルの email フィールドは重複しちゃダメ！ ※ただし、すでに登録してるものと同じ場合はスルーOK♪」
          Rule::unique('members', 'email')->ignore($member)
      ],
      'sex' => 'required|integer|in:1, 2',
//      'password' => 'required|min:8',
      // 【変更】こちらのご説明は「resources/views/member/index.blade.php」116行目ににございます
      'password' => 'required|min:8|confirmed',
    ];
  }

  public function messages()
  {
    return [
      'name.required' => 'お名前を入力してください。',
      'name.max' => 'お名前は20文字以内で入力してください。', // 【変更】数字を省略してもOKです ^^
      'email.required'  => 'メールアドレスをしてください。',
      'email.email'  => 'メールアドレスの形式を確認してください。',
      'email.max' => 'メールアドレスは100文字以内で入力してください。', // 【変更】数字を省略してもOKです ^^
      'email.unique' => 'このメールアドレスはすでに登録されています。', // 【追加】
      'sex.required' => '性別を選択してください。',
      'password.required' => 'パスワードを入力してください。',
      'password.min' => 'パスワードは8文字以上で入力してください。', // 【変更】数字を省略してもOKです ^^
      'password.confirmed' => 'パスワードが一致しません。', // 【追加】
    ];
  }
}
