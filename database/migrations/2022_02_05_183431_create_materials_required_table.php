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
            $table->integer('material_type_id')->unsigned();
            $table->foreign('material_type_id')->references('id')->on('material_types')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('material_class_id')->unsigned();
            $table->foreign('material_class_id')->references('id')->on('material_classes')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->float('quantity')->comment("total material required");
            $table->float('quantity_per_day')->comment("max total material required per day");
            $table->string('quantity_metric_unit');
            $table->string('currency');
            $table->string('lease_modality');
            $table->integer('modality_value');
            $table->string('cess');
            $table->text('description')->nullable();
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
