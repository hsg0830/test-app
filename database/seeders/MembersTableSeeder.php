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
        for ($i = 0; $i < 25; $i++) {

            $member = new Member();
            $member->name = 'テスト名 - ' . $i;
            $member->save();
        }
    }
}
