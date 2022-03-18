<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentStatusLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_status_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('equipment_inventory_id')->unsigned();
            $table->foreign('equipment_inventory_id')->references('id')->on('equipment_inventories')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->text('comment');
            $table->integer('status')->default(0)
                ->comment("0-pending approval- on equipment created
                1-Ready to work / approved - on equipment approved/ on vendor change status
                2-Engage externally- on vendor/admin change status
                3-Approval withheld - on admin update/approving
                4-Deactivated  - on admin change status
                5-On Maintenance - on vendor/admin change status
                6-Out of Service- on vendor/admin change status
                7-Engage - on email approval confirmation/ on admin add to requirement
                8-Suspended - on admin change status
                9-Approval declined- deleted after duration -on admin update/approving");
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
        Schema::dropIfExists('equipment_status_logs');
    }
}
