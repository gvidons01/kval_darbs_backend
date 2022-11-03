<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('categories')->insert([
        'ID' => 11,
        'category_name' => 'Vieglie auto',
        'group_id' => 1,
        'image' => file_get_contents("images/categories/car.png"),
      ]);
      \DB::table('categories')->insert([
        'ID' => 12,
        'category_name' => 'Kravas auto',
        'group_id' => 1,
        'image' => file_get_contents("images/categories/truck.png"),
      ]);
      \DB::table('categories')->insert([
        'ID' => 13,
        'category_name' => 'Motocikli',
        'group_id' => 1,
        'image' => file_get_contents("images/categories/motorbike.png"),
      ]);
      \DB::table('categories')->insert([
        'ID' => 14,
        'category_name' => 'Mopēdi',
        'group_id' => 1,
        'image' => file_get_contents("images/categories/moped.png"),
      ]);
      \DB::table('categories')->insert([
        'ID' => 15,
        'category_name' => 'Velosipēdi/skūteri',
        'group_id' => 1,
        'image' => file_get_contents("images/categories/track-bicycle.png"),
      ]);
      \DB::table('categories')->insert([
        'ID' => 16,
        'category_name' => 'Kvadracikli/bagiji',
        'group_id' => 1,
        'image' => file_get_contents("images/categories/buggy-car.png"),
      ]);
      \DB::table('categories')->insert([
        'ID' => 17,
        'category_name' => 'Kartingi',
        'group_id' => 1,
        'image' => file_get_contents("images/categories/karting.png"),
      ]);
      \DB::table('categories')->insert([
        'ID' => 18,
        'category_name' => 'Ūdens transports',
        'group_id' => 1,
        'image' => file_get_contents("images/categories/boat.png"),
      ]);
      \DB::table('categories')->insert([
        'ID' => 19,
        'category_name' => 'Piekabes/treileri',
        'group_id' => 1,
        'image' => file_get_contents("images/categories/trailer.png"),
      ]);
      \DB::table('categories')->insert([
        'ID' => 110,
        'category_name' => 'Rezerves daļas',
        'group_id' => 1,
        'image' => file_get_contents("images/categories/piston.png"),
      ]);
    }
}
