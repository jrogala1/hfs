<?php

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
        DB::table('categories')->insert([
            'name' => 'Matematyka',
            'general_category' => 'Matematyka',
        ]);

        DB::table('categories')->insert([
            'name' => 'Informatyka',
        ]);

        DB::table('categories')->insert([
            'name' => 'Algorytmy i złożoność',
            'general_category' => 'Matematyka',
        ]);
    }
}
