<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsRequiredTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials_required', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('site_id')->unsigned();
            $table->foreign('site_id')->references('id')->on('sites')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('task_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('tasks')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('material_type_id')->unsigned();
            $table->foreign('material_type_id')->references('id')->on('material_types')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('material_class_id')->unsigned();
            $table->foreign('material_class_id')->references('id')->on('material_classes')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->float('quantity_required')->comment("total material required");
            $table->string('quantity_required_unit');
            $table->float('quantity_required_per_day')->comment("max total material required per day");
            $table->string('quantity_required_per_day_unit');
            $table->string('currency');
            $table->string('lease_modality');
            $table->integer('lease_rates');
            $table->string('cess');
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
        Schema::dropIfExists('task_material_requireds');
    }
}
