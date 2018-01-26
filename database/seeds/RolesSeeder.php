<?php

use App\User;

class RolesSeeder extends \Illuminate\Database\Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        parent::run();

        DB::table('model_has_roles')->insert(array(
            array('model_type' => User::class, 'model_id' => 1, 'role_id' => 1),
        ));
    }
}
