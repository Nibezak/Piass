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
		/** Because the table will be droped by the eduction migration so there is no need to 
		to add any migration rollback from this level */
		return true;
	}

}
