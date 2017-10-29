<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new \App\Category();
        $category->name = 'Game';
        $category->save();

        $category = new \App\Category();
        $category->name = 'Pet';
        $category->save();

        $category = new \App\Category();
        $category->name = 'Clothes';
        $category->save();

        $category = new \App\Category();
        $category->name = 'Tech';
        $category->save();
    }
}
