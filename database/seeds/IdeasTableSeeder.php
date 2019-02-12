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
        Round::all()->each(function($round) {
            $round->ideas()->saveMany(factory(Idea::class, 5)->make());
        });
    }
}
