<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_inventories', function (Blueprint $table) {
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
            $table->integer('sub_county_id')->unsigned();
            $table->foreign('sub_county_id')->references('id')->on('sub_counties')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('status')->default(0)->comment("0-pending approval,1-instock,2-outstock,3-deleted");
            $table->string('ownership')->nullable();
            $table->text('description')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('materials');
    }
}
