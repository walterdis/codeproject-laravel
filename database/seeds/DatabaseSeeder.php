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
        $this->call('ProjectNoteTableSeeder');
        $this->call('ProjectTaskTableSeeder');


        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Model::reguard();
    }
}