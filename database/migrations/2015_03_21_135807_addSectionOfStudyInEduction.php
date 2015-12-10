<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSectionOfStudyInEduction extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('student_educations', function(Blueprint $table)
		{
	
			$table->string('section_of_study',40);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('student_educations', function($table)
		{
		    $table->dropColumn(['section_of_study']);
		});
	}

}
