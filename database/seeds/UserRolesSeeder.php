<?php

use Spatie\Permission\Models\Role;

class UserRolesSeeder extends BaseSeeder
{

    /**
     * @return array|\Illuminate\Support\Collection
     */
    protected function data() {
        return [
            [
                'id' => 1,
                'name' => 'admin',
                'guard_name' => 'web'
            ],
            [
                'id' => 2,
                'name' => 'user',
                'guard_name' => 'web'
            ],
        ];
    }


    /**
     * @return string
     */
    protected function model()
    {
        return Role::class;
    }
}
