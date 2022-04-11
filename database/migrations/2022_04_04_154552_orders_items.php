<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrdersItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_items', function(Blueprint $table) {
           $table->foreignUuid('order_id')
               ->references('id')
               ->on('orders');
           $table->foreignUuid('product_id')
               ->references('id')
               ->on('products');
           $table->integer('quantity')->default(1);
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
        //
    }
}
