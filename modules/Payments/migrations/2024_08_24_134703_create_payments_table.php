<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('agent', 200)->nullable();
            $table->string('agent_id', 10)->nullable();
            $table->string('amount', 200)->nullable();
            $table->text('description')->nullable();
            $table->interger('user_id', 10)->nullable();
            $table->interger('transaction_id', 10); ;

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
};
