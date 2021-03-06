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
        Schema::create('equipment_inventory_equipment_required', function (Blueprint $table) {
            $table->integer('equipment_inventory_id')->unsigned();
//            $table->foreign('equipment_inventory_id',"eq_inv_id_foreign")->references('id')->on('equipment_inventory')
//                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('equipment_required_id')->unsigned();
//            $table->foreign('equipment_required_id',"eq_re_id_foreign")->references('id')->on('equipment_required')
//                ->onUpdate('cascade')->onDelete('cascade');
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
