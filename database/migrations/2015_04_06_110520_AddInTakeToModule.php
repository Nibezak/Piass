<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddInTakeToModule extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('student_modules', function (Blueprint $table) {
			$table->string('intake');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('student_modules', function ($table) {
			$table->dropColumn(['intake']);
		});
	}

}
