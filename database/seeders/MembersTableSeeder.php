<?php

namespace Database\Seeders;

use App\Models\Member;  //※追加
use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //※シーディングの内容
        for ($i = 1; $i < 6; $i++) {

            $member = new Member();
            $member->name = 'メンバー' . $i;
            $member->email = 'user' . $i . '@example.com';
            $member->password = bcrypt('test1234');
            $member->sex = 1;
            $member->save();
        }
    }
}
