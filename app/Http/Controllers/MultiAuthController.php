<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;

class MultiAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('multi_auth.login');
    }

    public function login(Request $request)
    {
        // dd($request);
        $credentials = $request->only(['email', 'password']);
        $guard = $request->guard;
        $remember = $request->has('remember');  // チェックボックスはチェックされないとデータは存在しないので false になります。
        // \Debugbar::info($request);
        // $members = Member::get();
        // \Debugbar::info('$members=' . $members);
        // \Debugbar::info($members[0]->name);
        // \Debugbar::info($request->user());

        if (\Auth::guard($guard)->attempt($credentials, $remember)) { // attempt() 第２引数に remember をセットできます
            // return redirect($guard . '/dashboard');
            // return view('member.index', compact('members'));
            // return view('member.index')->with("members", $members);
            // return view('member.index')->with("members", $members);
            // var_dump(Auth::guard($guard)->user());
            return redirect('/member'); // ミドルウェア「auth:members」が守っているページへリダイレクト
//            return redirect('/members/dashboard');
//            dump(Auth::guard($guard)->user()->name);
//            return view('member.index');
        }

        return back()->withErrors([
            'auth' => ['認証に失敗しました']
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // ↓ここの処理がイマイチよく分かってない。。。
        // 合ってますよ ^^b
        return redirect('/multi_login');
    }
}
