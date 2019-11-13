<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->mediumText('description')->nullable();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            //$table->unsignedBigInteger('branchOffice_id')->nullable();
            $table->timestamps();

            /*Relations
            $table->foreign('branchOffice_id')->references('id')->on('branch_offices')
                ->onDelete('cascade')
                ->onUpdate('cascade');*/
            $table->foreign('warehouse_id')->references('id')->on('warehouses')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
