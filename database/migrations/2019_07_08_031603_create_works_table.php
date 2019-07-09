<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('batch', 20)->unique();
            $table->unsignedBigInteger('purchase_id');
            $table->string('description', 100)->nullable();
            $table->enum('status', ['process', 'finish', 'cancel'])->default('process');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('purchase_id')
                  ->references('id')->on('purchases')
                  ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('works');
    }
}
