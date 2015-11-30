<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOnlineRegistrationFields extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('students', function(Blueprint $table)
		{
			if (Schema::hasColumn('students', 'online_registered') == false) {
			
				$table->integer('online_registered')->default(0);
			}
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('students', function(Blueprint $table)
		{
			if (Schema::hasColumn('students', 'online_registered')) {
				
			$table->dropColumn('online_registered');
			}
		});
	}

}
