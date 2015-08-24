<?php

use Illuminate\Database\Migrations\Migration;

class AddSoftDeleteColumns extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('students', function ($table) {
			$table->softDeletes();
		});
		Schema::table('fee_transactions', function ($table) {
			$table->softDeletes();
		});
		Schema::table('faculities', function ($table) {
			$table->softDeletes();
		});
		Schema::table('departments', function ($table) {
			$table->softDeletes();
		});
		Schema::table('modules', function ($table) {
			$table->softDeletes();
		});
		Schema::table('student_modules', function ($table) {
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('students', function ($table) {
			$table->dropColumn('deleted_at');
		});
		Schema::table('fee_transactions', function ($table) {
			$table->dropColumn('deleted_at');
		});
		Schema::table('faculities', function ($table) {
			$table->dropColumn('deleted_at');
		});
		Schema::table('departments', function ($table) {
			$table->dropColumn('deleted_at');
		});
		Schema::table('modules', function ($table) {
			$table->dropColumn('deleted_at');
		});
		Schema::table('student_modules', function ($table) {
			$table->dropColumn('deleted_at');
		});}

}
