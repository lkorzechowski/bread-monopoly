<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldTable extends Migration
{

    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('field', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->enum('tile1', ['empty', 'green', 'yellow'])->default('empty');
            $table->enum('tile2', ['empty', 'green', 'yellow'])->default('empty');
            $table->enum('tile3', ['empty', 'green', 'yellow'])->default('empty');
            $table->enum('tile4', ['empty', 'green', 'yellow'])->default('empty');
        });
    }

    public function down()
    {
        Schema::dropIfExists('field');
    }
}
