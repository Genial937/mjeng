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
        Schema::create('material_inventory_material_required', function (Blueprint $table) {
            $table->integer('material_inventory_id')->unsigned();
            $table->foreign('material_inventory_id',"m_inv_id_foreign")->references('id')->on('material_inventory')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('material_required_id')->unsigned();
            $table->foreign('material_required_id',"m_re_id_foreign")->references('id')->on('materials_required')
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
