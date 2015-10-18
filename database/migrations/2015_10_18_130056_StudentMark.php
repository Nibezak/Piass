<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StudentMark extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_marks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('student_id');
			$table->string('student_registration_number');
			$table->integer('faculity_id');
			$table->integer('department_id');
			$table->integer('level');
			$table->integer('module_id');
			$table->string('module_name');
			$table->string('module_code');
			$table->string('academicYear');
			$table->decimal('marks',10,2);
			$table->integer('user_id');

			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('student_marks');
	}

}
