<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_task', function (Blueprint $table) {
            $table->integer('project_site_id')->unsigned();
            $table->foreign('project_site_id')->references('id')->on('project_sites')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('task_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('tasks')
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
        Schema::dropIfExists('project_site_tasks');
    }
}
