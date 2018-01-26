<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessoryPhoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessory_phone', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('accessory_id');
            $table->unsignedInteger('phone_id');
            $table->timestamps();

            $table
                ->foreign('accessory_id')
                ->references('id')
                ->on('accessories')
                ->onDelete('cascade');

            $table
                ->foreign('phone_id')
                ->references('id')
                ->on('phones')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accessory_phone');
    }
}
