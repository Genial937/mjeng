<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_inventory', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reg_no')->unique();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('equipment_type_id')->unsigned();
            $table->foreign('equipment_type_id')->references('id')->on('equipment_types')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('equipment_model_id')->unsigned();
            $table->foreign('equipment_model_id')->references('id')->on('equipment_models')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('plate_no');
            $table->string('yom');
            $table->string('axel');
            $table->string('tw')->comment("tare weight");
            $table->string('gw')->comment("gross weight");
            $table->text('description')->nullable();
            $table->string('ownership');
            $table->string('fuel_type');
            $table->string('engine_capacity');
            $table->integer('status')->default(0)->comment("0-pending approval,1-active,2-inactive,3-deleted");
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
        Schema::dropIfExists('equipment');
    }
}
