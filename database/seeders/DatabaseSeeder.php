<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        //※追加後に：php artisan migrate:fresh --seed
        $this->call(PostsTableSeeder::class);
        $this->call(MembersTableSeeder::class);
    }
}
