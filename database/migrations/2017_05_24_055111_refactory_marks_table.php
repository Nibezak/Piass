<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefactoryMarksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('student_marks', function(Blueprint $table)
		{
			   $table->decimal('cat',10,2);
			   $table->renameColumn('marks', 'exam');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('student_marks', function(Blueprint $table)
		{
			//
		});
	}

}
