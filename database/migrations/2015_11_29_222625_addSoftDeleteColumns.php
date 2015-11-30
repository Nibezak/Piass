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
			if (Schema::hasColumn('students', 'deleted_at') == false) {
				$table->softDeletes();
			}
		});
		Schema::table('fee_transactions', function ($table) {
			if (Schema::hasColumn('fee_transactions', 'deleted_at') == false) {
				$table->softDeletes();
			}
		});
		Schema::table('faculities', function ($table) {
			if (Schema::hasColumn('faculities', 'deleted_at') == false) {
				$table->softDeletes();
			}
		});
		Schema::table('departments', function ($table) {
			if (Schema::hasColumn('departments', 'deleted_at') == false) {
				$table->softDeletes();
			}
		});
		Schema::table('modules', function ($table) {
			if (Schema::hasColumn('modules', 'deleted_at') == false) {
				$table->softDeletes();
			}
		});
		Schema::table('student_modules', function ($table) {
			if (Schema::hasColumn('student_modules', 'deleted_at') == false) {
				$table->softDeletes();
			}
		});

		Schema::table('student_educations', function ($table) {
			if (Schema::hasColumn('student_educations', 'deleted_at') == false) {
				$table->softDeletes();
			}
		});
		Schema::table('files', function ($table) {
			if (Schema::hasColumn('files', 'deleted_at') == false) {
				$table->softDeletes();
			}
		});

		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('students', function ($table) {
			if (Schema::hasColumn('students', 'deleted_at')) {
			$table->dropColumn('deleted_at');
			}
		});
		Schema::table('fee_transactions', function ($table) {
			if (Schema::hasColumn('fee_transactions', 'deleted_at')) {
			$table->dropColumn('deleted_at');
			}
		});
		Schema::table('faculities', function ($table) {
			if (Schema::hasColumn('faculities', 'deleted_at')) {
			$table->dropColumn('deleted_at');
			}
		});
		Schema::table('departments', function ($table) {
			if (Schema::hasColumn('departments', 'deleted_at')) {
			$table->dropColumn('deleted_at');
			}
		});
		Schema::table('modules', function ($table) {
			if (Schema::hasColumn('modules', 'deleted_at')) {
			$table->dropColumn('deleted_at');
			}
		});
		Schema::table('student_modules', function ($table) {
			if (Schema::hasColumn('student_modules', 'deleted_at')) {
			$table->dropColumn('deleted_at');
			}
		});
		Schema::table('student_educations', function ($table) {
			if (Schema::hasColumn('student_educations', 'deleted_at')) {
			$table->dropColumn('deleted_at');
			}
		});
		Schema::table('files', function ($table) {
			if (Schema::hasColumn('files', 'deleted_at')) {
			$table->dropColumn('deleted_at');
			}
		});
		
	}

}
