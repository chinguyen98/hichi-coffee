<?php

use App\Coffee;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('test:test2 {var=123} {var2=456} {--opt=123}', function ($var2, $var, $opt) {
    echo "{$var} - {$var2} {$opt}\n";
})->describe('test2 ne');

Artisan::command('test:test3 {arr*}', function ($arr) {
    foreach ($arr as $item) {
        echo "{$item} - ";
    }
})->describe('test3 ne');

Artisan::command('test:test4 {--id=*}', function ($id) {
    foreach ($id as $item) {
        echo "{$item} - ";
    }
})->describe('test3 ne');

Artisan::command('test:test5', function () {
    $name = $this->ask('what your name!');
    $this->line("Your name is {$name}!");
    $age = $this->anticipate('what age?', ['qweqweqwe', 'asdas', 'xcz']);
    $this->error($age);
    $choice = $this->choice(
        'Test choice',
        ['choice1', 'choice2'],
        1,
    );
    $this->info($choice);
});

Artisan::command('test:test6 {--a|opt1=1} {--b|opt2=2}', function ($opt1, $opt2) {
    $this->info("{$opt1} {$opt2}");
});

Artisan::command('test:table', function () {
    $coffees = Coffee::limit(10)->get(['name', 'price'])->toArray();
    //$coffees = DB::table('coffees')->limit(10)->get(['name', 'price'])->toArray();
    $headers = ['Name', 'Price'];
    $this->table($headers, $coffees);
});

Artisan::command('test:progress', function () {
    $users = Coffee::all();

    $bar = $this->output->createProgressBar(count($users));

    $bar->start();

    foreach ($users as $key => $user) {
        //$this->performTask($user);

        $bar->advance($key);
    }

    $bar->finish();
});
