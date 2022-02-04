<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('referral_code');
            $table->string('firstname');
            $table->string("customer_code")->unique();
            $table->string('middlename')->nullable();
            $table->string('surname')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->unique();
            $table->string('doc_type')->default('ID');
            $table->string('doc_no');
            $table->integer('sub_county_id')->unsigned();
            $table->foreign('sub_county_id')->references('id')->on('sub_counties')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('village')->nullable();
            $table->string('user_type')->default("MEMBER");
            $table->string('password');
            $table->text('notes')->nullable();
            $table->smallInteger('status')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
