<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use app\Models\group;
use app\Models\category;
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
      ]);
        // \App\Models\User::factory(10)->create();

    }
}
