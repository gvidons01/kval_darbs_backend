<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use app\Models\group;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('groups')->insert([
        'ID' => 1,
        'group_name' => 'Transports',
        'image' => file_get_contents("images/groups/car.png"),
      ]);
      \DB::table('groups')->insert([
        'ID' => 2,
        'group_name' => 'Nekustamais īpašums',
        'image' => file_get_contents("images/groups/home.png"),
      ]);
      \DB::table('groups')->insert([
        'ID' => 3,
        'group_name' => 'Elektrotehnika',
        'image' => file_get_contents("images/groups/responsive.png"),
      ]);
      \DB::table('groups')->insert([
        'ID' => 4,
        'group_name' => 'Apģērbs',
        'image' => file_get_contents("images/groups/tshirt.png"),
      ]);
      \DB::table('groups')->insert([
        'ID' => 5,
        'group_name' => 'Mājai',
        'image' => file_get_contents("images/groups/shelf.png"),
      ]);
      \DB::table('groups')->insert([
        'ID' => 6,
        'group_name' => 'Bērniem',
        'image' => file_get_contents("images/groups/baby-boy.png"),
      ]);
      \DB::table('groups')->insert([
        'ID' => 7,
        'group_name' => 'Atpūtai/hobijiem',
        'image' => file_get_contents("images/groups/hiking.png"),
      ]);
      \DB::table('groups')->insert([
        'ID' => 8,
        'group_name' => 'Lauksaimniecībai',
        'image' => file_get_contents("images/groups/tractor.png"),
      ]);
      \DB::table('groups')->insert([
        'ID' => 9,
        'group_name' => 'Celtniecībai',
        'image' => file_get_contents("images/groups/helmet.png"),
      ]);
      \DB::table('groups')->insert([
        'ID' => 10,
        'group_name' => 'Dārzam',
        'image' => file_get_contents("images/groups/gardening.png"),
      ]);
        // \App\Models\User::factory(10)->create();
    }
}
