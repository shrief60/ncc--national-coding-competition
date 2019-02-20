<?php

use App\User;
use App\Friend;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FriendsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        $users->each(function($user) {

            $user->each(function($friend) use($user) {
                if($user->id != $friend->id) {
                    $data = [
                        [
                            'user_id' => $friend->id,
                            'friend_id' => $user->id,
                            'created_at' => Carbon::now(),
                        ],
                        [
                            'user_id' => $user->id,
                            'friend_id' => $friend->id,
                            'created_at' => Carbon::now(),
                        ],
                    ];

                    Friend::insert($data);
                }
            });

        });
    }
}
