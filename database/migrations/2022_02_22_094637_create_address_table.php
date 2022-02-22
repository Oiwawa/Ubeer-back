<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('address');
            $table->string('zipcode');
            $table->string('city');
            $table->timestamps();
        });

        Schema::table('user', function (Blueprint $table) {
            $table->uuid('address_id');
            $table->foreign('address_id')
                ->references('id')
                ->on('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
}
