<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentModulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_modules', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('student_id');
			$table->foreign('student_id')->references('id')->on('students');
			
			$table->integer('module_id');
			$table->foreign('module_id')->references('id')->on('modules');

			$table->string('name');
			$table->string('code',20);
			$table->integer('credits');
			$table->integer('credit_cost');
			$table->decimal('amount',10,2);
			$table->integer('department_level');

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
		Schema::drop('student_modules');
	}

}
