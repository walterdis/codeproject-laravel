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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        CodeProject\Entities\Client::truncate();

        $this->call('UserTableSeeder');
        factory(CodeProject\Entities\Client::class, 10)->create();

        $this->call('ProjectTableSeeder');


        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Model::reguard();
    }
}

class UserTableSeeder extends Seeder {

    public function run()
    {
        \CodeProject\User::truncate();

        foreach(range(1, 10) as $key) {
            factory(\CodeProject\User::class)->create([
                'email' => "admin{$key}@admin.com"
            ]);
        }
    }
}

class ProjectTableSeeder extends Seeder
{
    public function run()
    {
        \CodeProject\Entities\Project::truncate();

        $users = \CodeProject\User::lists('id')->toArray();
        $clients = \CodeProject\Entities\Client::lists('id')->toArray();

        foreach(range(1, 20) as $key) {
            shuffle($users);
            shuffle($clients);

            factory(CodeProject\Entities\Project::class)->create([
                'owner_id' => $users[1],
                'client_id' => $clients[1],
            ]);
        }


    }
}

