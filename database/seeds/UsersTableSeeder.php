<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Rogal',
            'email' => 'rogal@test.pl',
            'password' => bcrypt('siusiak')
        ]);

        DB::table('users')->insert([
            'name' => 'Test',
            'email' => 'test1@test.pl',
            'password' => bcrypt('siusiak')
        ]);
    }
}

/*
$table->bigIncrements('id');
$table->string('name');
$table->string('email')->unique();
$table->timestamp('email_verified_at')->nullable();
$table->string('password');
$table->rememberToken();
$table->timestamps();*/