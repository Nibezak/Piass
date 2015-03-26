<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration {

	 public function up()
    {
        DB::statement( 'CREATE VIEW V_STUDENT_REPORTS AS SELECT
						/** Selecting Student columns */
						names,
						DOB,
						gender,
						martial_status,
						NID,
						telephone,
						email,
						occupation,
						residence,
						nationality,
						father_name,
						mother_name,
						mode_of_study,
						session,
						registration_number,
						campus,
						department_id,
						created_by,
						updated_by

						FROM students as S
						');
    }

    public function down()
    {
        DB::statement( 'DROP VIEW V_STUDENT_REPORTS' );
    }

}
