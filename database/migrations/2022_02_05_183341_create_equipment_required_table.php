<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentRequiredTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_required', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('equipment_type_id')->unsigned();
            $table->foreign('equipment_type_id')->references('id')->on('equipment_types')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('no_equipment');
            $table->float('payload_capacity');
            $table->string('duration_type');
            $table->float('duration_value');
            $table->float('currency')->comment("KES");
            $table->float('lease_rates')->comment("1000");
            $table->string('lease_modality')->comment("per month,per day ect");
            $table->string('fuel_provision');
            $table->string('cess_provision');
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
        Schema::dropIfExists('task_equipment_requireds');
    }
}
