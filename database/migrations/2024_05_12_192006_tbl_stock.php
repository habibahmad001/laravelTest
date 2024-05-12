<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_stock', function (Blueprint $table) {
            $table->id();
            $table->string( 'name', 256)->nullable();
            $table->string( 'qty', 256)->nullable();
            $table->bigInteger('stock')->nullable();
            $table->bigInteger('price')->nullable();
            $table->bigInteger('total_price')->nullable();
            $table->enum('status', array('yes', 'no'))->default('no');
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
        Schema::dropIfExists('tbl_stock');
    }
}
