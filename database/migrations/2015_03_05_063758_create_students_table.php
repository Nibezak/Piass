<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('students', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->string('names');
			$table->timestamp('DOB');
			$table->string('gender');
			$table->string('martial_status');
			$table->string('NID',16);
			$table->string('telephone',12);
			$table->string('email');
			$table->string('occupation');
			$table->string('residence');
			$table->string('nationality');
			$table->string('father_name');
			$table->string('mother_name');

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
		Schema::drop('students');
	}

}
