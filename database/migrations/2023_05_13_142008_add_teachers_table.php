<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->bigInteger('specialize_id')->unsigned();
            $table->bigInteger('gender_id')->unsigned();
            $table->string('address')->nullable();
            $table->date('Joining_Date');
            $table->timestamps();

            $table->foreign('specialize_id')->references('id')->on('spechalizations')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('gender_id')->references('id')->on('genders')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
