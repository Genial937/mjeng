<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EquipmentInventoryEquipementRequired extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('einventory_required', function (Blueprint $table) {
            $table->integer('equipment_inventory_id')->unsigned();
            $table->foreign('equipment_inventory_id')->references('id')->on('equipment_inventory')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('equipment_required_id')->unsigned();
            $table->foreign('equipment_required_id')->references('id')->on('equipment_required')
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
