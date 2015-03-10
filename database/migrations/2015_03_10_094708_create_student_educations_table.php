<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentEducationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_educations', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->string('qualification',10);
			$table->string('subjects');
			$table->string('school_attended');
			$table->string('completion_year');
			$table->integer('student_id');
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
		Schema::drop('student_educations');
	}

}
