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
        Schema::create('agents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',200);
            $table->integer('creator')->unsigned();
            $table->string('email',100)->unique();
            $table->string('password',100);
            $table->rememberToken();
            $table->string('code_agent',200)->nullable();
            $table->string('game',255)->nullable();
            $table->string('syntax',100)->nullable();
            $table->string('phone',20)->nullable();
            $table->string('facebook',200)->nullable();
            $table->string('bank_account',200)->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('agents');
    }
};
