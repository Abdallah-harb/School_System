<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSectionsTable extends Migration {

	public function up()
	{
		Schema::create('sections', function(Blueprint $table) {
			$table->id();
			$table->string('section_name');
			$table->integer('status');
			$table->bigInteger('grade_id')->unsigned();
			$table->bigInteger('classroom_id')->unsigned();
			$table->timestamps();

            $table->foreign('grade_id')->references('id')->on('grades')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('classroom_id')->references('id')->on('classrooms')
                ->onDelete('cascade')
                ->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::drop('sections');
	}
}
