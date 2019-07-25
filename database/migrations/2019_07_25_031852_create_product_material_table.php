<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_material', function (Blueprint $table) {
            $table->bigInteger('product_id');
            $table->bigInteger('material_id');

            $table->foreign('product_id')
                  ->references('id')->on('products')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreign('material_id')
                  ->references('id')->on('materials')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_material');
    }
}
