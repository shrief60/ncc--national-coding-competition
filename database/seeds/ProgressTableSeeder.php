<?php

use App\User;
use App\Round;
use Illuminate\Database\Seeder;

class ProgressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function($user) {

            $idea = Round::first()->ideas()->inRandomOrder()->first();

            $idea->users()->attach($user, [
                'round_id' => $idea->round_id
            ]);
        });
    }
}
