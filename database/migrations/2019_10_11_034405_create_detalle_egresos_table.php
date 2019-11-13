<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleEgresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_egresos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('egreso_id')->unsigned();
            $table->unsignedBigInteger('product_id')->unsigned();
            $table->unsignedBigInteger('inventory_id')->unsigned();
            $table->integer('quantity');
            $table->decimal('price',11,2);
            $table->decimal('discount',11,2)->default(0);
            $table->date('date')->nullable();
            $table->timestamps();

            $table->foreign('egreso_id')->references('id')->on('egresos')
                ->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('inventory_id')->references('id')->on('inventories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_egresos');
    }
}
