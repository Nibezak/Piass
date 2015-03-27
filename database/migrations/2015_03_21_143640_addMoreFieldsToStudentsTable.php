<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreFieldsToStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('students', function(Blueprint $table)
		{
			
			$table->string('mode_of_study');
			$table->string('session');
			$table->string('registration_number');
			$table->string('campus');
			$table->integer('department_id');
			$table->integer('created_by');
			$table->integer('updated_by');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('students', function($table)
		{
		    $table->dropColumn(['mode_of_study', 'session', 'registration_number','campus', 'department_id','created_by','updated_by']);
		});
	}

}
