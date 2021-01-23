<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
  public function index()
  {
    return view('member.index');
  }

  public function list()
  {
    return Member::get();
  }

  // public function show(Member $member)
  // {
  //   return view('member.show')->with([
  //     'member' => $member
  //   ]);
  // }

  public function store(Request $request)
  {
    // バリデーションは省略してます
    $member = new Member();
    $member->name = $request->name;
    $result = $member->save();

    // return [
    //   'result' => $result,
    //   'test1' => 'test1'
    // ];
    return ['result' => $result];
  }

  public function update(Request $request, Member $member)
  {
    // バリデーションは省略してます
    $member->name = $request->name;
    $result = $member->save();

    return ['result' => $result];
  }

  public function destroy(Member $member)
  {
    return [
      'result' => $member->delete()
    ];
  }
}
