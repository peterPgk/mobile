<?php

use App\User;

class UsersSeeder extends BaseSeeder
{

    /**
     * @return array|\Illuminate\Support\Collection
     */
    protected function data() {
        return [
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@site.bg',
                'password' => bcrypt('123123')
            ],
            [
                'id' => 2,
                'name' => 'User',
                'email' => 'user@site.bg',
                'password' => bcrypt('123123')
            ],
        ];
    }


    /**
     * @return string
     */
    protected function model()
    {
        return User::class;
    }
}
