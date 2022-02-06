<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MaterialClassMaterialType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_class_material_type', function (Blueprint $table) {
            $table->integer('material_type_id')->unsigned();
            $table->foreign('material_type_id')->references('id')->on('material_types')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('material_class_id')->unsigned();
            $table->foreign('material_class_id')->references('id')->on('material_classes')
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
