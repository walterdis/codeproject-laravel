<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \CodeProject\User::truncate();

        factory(\CodeProject\User::class)->create([
            'email' => "admin@admin.com",
            'password' => '12345',
            'name' => 'Admin',
            'remember_token' => str_random(10)
        ]);

        foreach(range(1, 10) as $key) {
            factory(\CodeProject\User::class)->create([
                'email' => "admin{$key}@admin.com"
            ]);
        }
    }
}
