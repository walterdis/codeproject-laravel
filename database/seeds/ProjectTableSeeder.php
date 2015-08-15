<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
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

        $projects = \CodeProject\Entities\Project::all();
        foreach($projects as $project) {
            $project->members()->detach();
            $project->members()->attach([1, mt_rand(1, 20)]);
        }
    }
}
