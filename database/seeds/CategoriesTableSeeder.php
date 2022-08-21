<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Lingerie',
            'slug' => 'Pyjama'
            ]);

        Category::create([
            'name' => 'Bijoux',
            'slug' => 'Chaines et perles'
            ]);

        Category::create([
         'name' => 'Chaussettes',
         'slug' => 'Longues et basses'
            ]);

        Category::create([
        'name' => 'Crèmes',
        'slug' => 'pommades et savons'
           ]);

        Category::create([
        'name' => 'Parfums',
        'slug' => 'échantillons et déodorants'
           ]);
    }
}
