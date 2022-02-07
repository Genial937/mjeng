<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MaterialInventoryMaterialRequired extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_inventory_required', function (Blueprint $table) {
            $table->integer('material_inventory_id')->unsigned();
            $table->foreign('material_inventory_id')->references('id')->on('material_inventory')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('material_required_id')->unsigned();
            $table->foreign('material_required_id')->references('id')->on('material_required')
                ->onUpdate('cascade')->onDelete('cascade');
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
