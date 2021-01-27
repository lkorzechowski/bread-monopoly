<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLedgerTable extends Migration
{

    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('user_ledger', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('balance');
            $table->integer('grain');
            $table->integer('flour');
            $table->integer('bread');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_ledger');
    }
}
