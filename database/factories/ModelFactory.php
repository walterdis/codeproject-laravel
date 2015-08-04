<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(CodeProject\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => 12345,
        'remember_token' => str_random(10),
    ];
});

$factory->define(CodeProject\Entities\Client::class, function ($faker) {
    /** @var $faker Faker\Generator */
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'responsible' => $faker->name,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'obs' => $faker->sentence,
    ];
});

$factory->define(CodeProject\Entities\Project::class, function ($faker) {
    /** @var $faker Faker\Generator */

    $status = ['a', 'b', 'c'];
    shuffle($status);

    return [
        'owner_id' => 1,
        'client_id' => 1,
        'name' => 'Project '.$faker->name,
        'description' => $faker->sentence(),
        'progress' => mt_rand(10, 100),
        'status' => $status[1],
        'due_date' => $faker->dateTimeBetween('-5 days', '+5 days'),
    ];
});

$factory->define(CodeProject\Entities\ProjectNote::class, function ($faker) {
    /** @var $faker Faker\Generator */

    return [
        'project_id' => mt_rand(1,20),
        'title' => 'Note '.$faker->word,
        'note' => $faker->paragraph(),
    ];
});

$factory->define(CodeProject\Entities\ProjectTask::class, function ($faker) {
    /** @var $faker Faker\Generator */

    return [
        'project_id' => mt_rand(1,20),
        'name' => 'Task: '.$faker->paragraph(mt_rand(1, 2)),
        'start_date' => $faker->dateTimeBetween('-5 days', '+5 days'),
        'due_date' => $faker->dateTimeBetween('+5 days', '+10 days'),
        'status' => mt_rand(1, 4)
    ];
});

