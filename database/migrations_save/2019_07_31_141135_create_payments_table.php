<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('user_id');

            $table->string('address');
            $table->string('type');

            $table->string('ammount');
            $table->string('ammout_remain')->default(0);
            $table->unsignedInteger('ammount_usd');
            $table->char('curency', 10);

            $table->smallInteger('status');
            $table->string('status_text')->default('Waiting for buyer funds..   ')->nuleable();
            $table->boolean('succes');

            $table->string('txn_id');
            $table->string('qr_link');
            $table->string('status_link');


            $table->unsignedInteger('timeout');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
