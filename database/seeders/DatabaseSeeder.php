<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use app\Models\group;
use app\Models\category;
use app\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call([
        GroupSeeder::class,
        CategorySeeder::class,
        //UserSeeder::class,
      ]);
      \App\Models\User::factory(10)->create();

    }
}
