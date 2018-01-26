<?php
/**
 * Created by PhpStorm.
 * User: pgk
 * Date: 22.1.2018 г.
 * Time: 12:02
 */

use \Illuminate\Database\Seeder;

abstract class BaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect( $this->data() )
            ->each( function( $item ) {
                $this->model()::create( $item );
            });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|string
     */
    abstract protected function model();

    /**
     * @return array|\Illuminate\Support\Collection
     */
    abstract protected function data();
}