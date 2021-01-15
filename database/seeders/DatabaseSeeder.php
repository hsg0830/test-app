<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        //※追加後に：php artisan migrate:fresh --seed
        $this->call(PostsTableSeeder::class);
        $this->call(MembersTableSeeder::class);
    }
}
