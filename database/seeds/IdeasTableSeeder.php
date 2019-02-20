<?php

use App\Idea;
use App\Round;
use Illuminate\Database\Seeder;

class IdeasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $ideas = [
            'Create an application to show how different creatures eat different food in a food chain',
            'Create an app to simulate a journey through a hazardous environment',
            'Create a modal solar or planetary system',
            'Create a model traffic system with a range of vehicles',
            'Create a simulated habitat and the creatures which live there'
        ];
        Round::all()->each(function ($round) use ($ideas) {

            foreach ($ideas as $idea) {
                $round->ideas()->save(factory(Idea::class )->make([
                    'description' => $idea
                ]));
            }
        });
    }
}
