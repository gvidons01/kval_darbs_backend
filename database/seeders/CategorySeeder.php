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
        'category_name' => 'Vieglie auto',
        'group_id' => 1,
        'image' => file_get_contents("images/categories/car.png"),
        'url' => 'cars',
      ]);
      \DB::table('categories')->insert([
        'category_name' => 'Kravas auto',
        'group_id' => 1,
        'image' => file_get_contents("images/categories/truck.png"),
        'url' => 'trucks',
      ]);
      \DB::table('categories')->insert([
        'category_name' => 'Motocikli',
        'group_id' => 1,
        'image' => file_get_contents("images/categories/motorbike.png"),
        'url' => 'motorcycles',
      ]);
      \DB::table('categories')->insert([
        'category_name' => 'Mopēdi',
        'group_id' => 1,
        'image' => file_get_contents("images/categories/moped.png"),
        'url' => 'mopeds',
      ]);
      \DB::table('categories')->insert([
        'category_name' => 'Velosipēdi/skūteri',
        'group_id' => 1,
        'image' => file_get_contents("images/categories/track-bicycle.png"),
        'url' => 'bicycles',
      ]);
      \DB::table('categories')->insert([
        'category_name' => 'Kvadracikli/bagiji',
        'group_id' => 1,
        'image' => file_get_contents("images/categories/buggy-car.png"),
        'url' => 'atvs',
      ]);
      \DB::table('categories')->insert([
        'category_name' => 'Kartingi',
        'group_id' => 1,
        'image' => file_get_contents("images/categories/karting.png"),
        'url' => 'gokarts',
      ]);
      \DB::table('categories')->insert([
        'category_name' => 'Ūdens transports',
        'group_id' => 1,
        'image' => file_get_contents("images/categories/boat.png"),
        'url' => 'aquatic',
      ]);
      \DB::table('categories')->insert([
        'category_name' => 'Piekabes/treileri',
        'group_id' => 1,
        'image' => file_get_contents("images/categories/trailer.png"),
        'url' => 'trailers',
      ]);
      \DB::table('categories')->insert([
        'category_name' => 'Rezerves daļas',
        'group_id' => 1,
        'image' => file_get_contents("images/categories/piston.png"),
        'url' => 'spare-parts',
      ]);

      \DB::table('categories')->insert([
        'category_name' => 'Dzīvokļi',
        'group_id' => 2,
        'image' => file_get_contents("images/categories/apartment.png"),
        'url' => 'flats',
      ]);
    }
}
