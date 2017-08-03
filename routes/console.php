<?php

use App\User;
use Faker\Factory;
use Illuminate\Foundation\Inspiring;

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
Artisan::command('matches:create', function () {
    $ids = [942808,942807,942800,942802,942803,
        918893,918901,918902,918900,918897,
        920533,920535,920537,920536,
        855542,855543,855544,855545,
        853509,853510,853511,853512,
        869830,869835,869828,869832
        ];
    foreach($ids as $id){
        $match = \App\Match::firstOrCreate(['opta_id'=>$id]);
        $this->info('Match: '.$match->id);
        $match->channel = '600dtsc';
        $match->updateOptaData();
        $week = $match->when->weekOfYear;
        $week_name = 'Semana '.$week;
        $start = $match->when->startOfWeek();
        $end = $match->when->endOfWeek();
        $this->info($week_name . ': ' . $start . ' - ' . $end);
        $round = \App\Round::firstOrCreate(['name'=>$week_name]);
        $round->start = $start;
        $round->end = $end;
        $round->save();
        $match->roundId()->associate($round);
        $match->save();


    }
})->describe('Creates demo matches');
Artisan::command('users:create {limit?}', function ($limit = 1) {
//    $faker = Factory::create();
    $rounds = \App\Round::all();
    factory(User::class, $limit)->create()->each(function ($u) use($rounds) {
        foreach ($rounds as $round){
            foreach ($round->matches as $match){
                $options = ['draw','local','visit'];
                $u->predictions()->create(['match_id'=>$match->id,'value'=>$options[rand(0,2)]]);
            }
        }
    });
    foreach ($rounds as $round){
        foreach ($round->matches as $match){
            $match->calculatePoints();
        }
    }
})->describe('Creates demo users with predictions');
