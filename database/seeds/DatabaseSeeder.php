<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        CodeProject\Model\Client::truncate();
        // $this->call(UserTableSeeder::class);
        factory(CodeProject\Model\Client::class, 10)->create();

        Model::reguard();
    }
}

