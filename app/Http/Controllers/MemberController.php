<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Http\Requests\CreateMemberRequest;
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

  public function store(CreateMemberRequest $request)
  {
    $member = new Member();
    $member->name = $request->name;
    $member->email = $request->email;
    $member->sex = $request->sex;
    $member->password = bcrypt($request->password);
    $result = $member->save();

    // return [
    //   'result' => $result,
    //   'test1' => 'test1'
    // ];
    return ['result' => $result];
  }

  public function update(CreateMemberRequest $request, Member $member)
  {
    $member->name = $request->name;
    $member->email = $request->email;
    $member->sex = $request->sex;
    $member->password = bcrypt($request->password);
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
