<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_inventory', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reg_no')->unique();
            $table->integer('business_id')->unsigned();
            $table->foreign('business_id')->references('id')->on('businesses')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('material_type_id')->unsigned();
            $table->foreign('material_type_id')->references('id')->on('material_types')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('material_class_id')->unsigned();
            $table->foreign('material_class_id')->references('id')->on('material_classes')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('status')->default(0)->comment("0-pending approval,1-active,2-inactive,3-deleted");
            $table->text('comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials');
    }
}
