<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            [
                'name' => 'Shady Sherif',
                'username' => 'shady',
                'email' => 'shady@user.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Hossam Houssien',
                'username' => 'hossam',
                'email' => 'hossam@user.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Sherif Mohamed',
                'username' => 'sherif',
                'email' => 'sherif@user.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Youmna Magdy',
                'username' => 'youmna',
                'email' => 'youmna@user.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Roaya Mohsen',
                'username' => 'roaya',
                'email' => 'roaya@user.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Mohamed Shalaby',
                'username' => 'shalaby',
                'email' => 'shalaby@user.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Abd El-Rahman',
                'username' => 'abdelrahman',
                'email' => 'abdelrahman@user.com',
                'password' => bcrypt('123456')
            ]
        );

        User::insert($users);
    }
}
