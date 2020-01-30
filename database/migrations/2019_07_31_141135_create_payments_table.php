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

            $table->string('address')->nullable();
            $table->string('type');

            $table->string('amount');
            $table->string('amount_remain')->default(0);
            $table->unsignedInteger('amount_usd')->nullable();
            $table->char('curency', 10)->nullable();

            $table->smallInteger('status');
            $table->string('status_text')->default('Waiting for buyer funds..   ')->nuleable();
            $table->boolean('succes')->nullable();

            $table->string('txn_id')->nullable();
            $table->string('qr_link')->nullable();
            $table->string('status_link')->nullable();


            $table->unsignedInteger('timeout')->nullable();



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
