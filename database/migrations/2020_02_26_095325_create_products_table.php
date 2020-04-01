<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('products', function($table) {
        $table->increments('id', true);
        $table->string('name');
        $table->text('detail');
        $table->integer('price');
        $table->integer('stock');
        $table->integer('discount');
        $table->timestamps('timecreated');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
