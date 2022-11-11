<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('groups')->insert([
        'group_name' => 'Transports',
        'image' => file_get_contents("images/groups/car.png"),
        'url' => 'vehicles',
      ]);
      \DB::table('groups')->insert([
        'group_name' => 'Nekustamais īpašums',
        'image' => file_get_contents("images/groups/home.png"),
        'url' => 'real-estate',
      ]);
      \DB::table('groups')->insert([
        'group_name' => 'Elektrotehnika',
        'image' => file_get_contents("images/groups/responsive.png"),
        'url' => 'electronics',
      ]);
      \DB::table('groups')->insert([
        'group_name' => 'Apģērbs',
        'image' => file_get_contents("images/groups/tshirt.png"),
        'url' => 'clothing',
      ]);
      \DB::table('groups')->insert([
        'group_name' => 'Mājai',
        'image' => file_get_contents("images/groups/shelf.png"),
        'url' => 'for-home',
      ]);
      \DB::table('groups')->insert([
        'group_name' => 'Bērniem',
        'image' => file_get_contents("images/groups/baby-boy.png"),
        'url' => 'for-kids',
      ]);
      \DB::table('groups')->insert([
        'group_name' => 'Atpūtai/hobijiem',
        'image' => file_get_contents("images/groups/hiking.png"),
        'url' => 'entertainment',
      ]);
      \DB::table('groups')->insert([
        'group_name' => 'Lauksaimniecībai',
        'image' => file_get_contents("images/groups/tractor.png"),
        'url' => 'agriculture',
      ]);
      \DB::table('groups')->insert([
        'group_name' => 'Celtniecībai',
        'image' => file_get_contents("images/groups/helmet.png"),
        'url' => 'construction',
      ]);
      \DB::table('groups')->insert([
        'group_name' => 'Dārzam',
        'image' => file_get_contents("images/groups/gardening.png"),
        'url' => 'gardening',
      ]);
    }
}
