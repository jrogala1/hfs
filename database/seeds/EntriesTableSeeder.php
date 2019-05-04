<?php

use Illuminate\Database\Seeder;

class EntriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entries')->insert([
            'user_id' => '1',
            'category_id' => '1',
            'title' => 'Testowa sciaaga',
            'description' => 'Opis testoweaaaaaaj sciagi',
            'article_file' => 'fileloc',
            'image_file' => 'imgloc'
        ]);

        DB::table('entries')->insert([
            'user_id' => '1',
            'category_id' => '3',
            'title' => 'Testowa sciaaga',
            'description' => 'Test',
            'article_file' => 'fileloc',
            'image_file' => 'imgloc',
            'votes_up' => '2'
        ]);

        DB::table('entries')->insert([
            'user_id' => '1',
            'category_id' => '3',
            'title' => 'Sciaga numer ',
            'description' => 'Powazna sciaga',
            'article_file' => 'fileloc',
            'image_file' => 'imgloc'
        ]);
    }
}
/*
$table->bigIncrements('id');
$table->bigInteger('user_id')->unsigned();
$table->foreign('user_id')->references('id')->on('users');
$table->text('title');
$table->mediumText('description');
$table->integer('votes_up')->default(0);
$table->integer('votes_down')->default(0);
$table->string('file_location', 255);
$table->dateTime('created_at');*/