<?php

use App\Round;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoundsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($round= 1; $round <= 3; $round++) {
            Round::create([
                'name' => "Round $round",
                'started' => $round == 1,
                'due_date' => $round == 1 ? Carbon::now()->addDays(5) : null
            ]);
        }
    }
}
