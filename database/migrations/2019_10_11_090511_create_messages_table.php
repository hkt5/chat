<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->text('message')->nullable(false);
            $table->bigInteger('channel_id')->nullable(false);
            $table->bigInteger('user_id')->nullable(false);
            $table->timestamps();
            //$table->foreign('channel_id')->references('id')->on('channels')
                //->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('messages');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
