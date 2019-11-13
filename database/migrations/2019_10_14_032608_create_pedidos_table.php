<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('shopping_cart_id')->unsigned();
            $table->unsignedBigInteger('customer_id')->unsigned();
            $table->string('state');
            $table->dateTime('order_date');
            $table->date('date');
            $table->time('hour');
            $table->string('status')->default('creado');
            $table->string('guide_number')->nullable();
            $table->decimal('total',8,2);
            $table->timestamps();

            //Relations
            $table->foreign('shopping_cart_id')->references('id')->on('shopping_carts');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
