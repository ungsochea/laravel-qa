<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {
    return [
        'title' =>rtrim($faker->sentence(rand(5,10)),"."),
        'body'  =>$faker->paragraph(rand(3,7),true),
        'views' =>rand(0,10),
        'answers_count' =>rand(0,10),
        'votes' =>rand(-3,10),
    ];
});
// php aritsan tinker
//factory(App\User::class,3)->create()
