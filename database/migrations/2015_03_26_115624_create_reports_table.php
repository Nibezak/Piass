<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration {

	public function up()
    {
    	// CREATE STUDENT LEVELS VIEW 
    	DB::statement('CREATE VIEW V_STUDENT_LEVELS AS 
    				     SELECT student_id, 
    				     MAX( department_level ) AS Level
						FROM student_modules
						GROUP BY student_id'
						);

    	 // CREATE STUDENT STUDENT FEES VIEW
    	DB::statement('CREATE VIEW V_STUDENT_FEES AS 
			    		SELECT 
			    		student_id,
			    		sum(debit) as debit,
			    		sum(credit) as credit,
			    		sum(debit)-sum(credit) as balance 
			    		FROM `fee_transactions` 
		    		  GROUP BY student_id');

    	// CREATE FINAL STUDENT TABLE 
        DB::statement( 'CREATE VIEW V_STUDENT_REPORTS AS SELECT
					 /** Selecting Student columns */
						names,
						DOB,
						gender,
						martial_status,
						NID,
						telephone,
						s.email,
						occupation,
						residence,
						nationality,
						father_name,
						mother_name,
						mode_of_study,
						session,
						registration_number,
						campus,
						level,
						register.email as created_by,
						updator.email  as updated_by,
						/** Student Educations columns */
						qualification,
						subjects,
						school_attended,
						completion_year,
						/** Student department columns */
						d.name as Department,
						/** Student FACULITY columns */
						f.name as Faculity,
						debit,
						credit,
						balance
						FROM students as s
						LEFT JOIN student_educations e ON s.id = e.student_id
						LEFT JOIN departments as d ON s.department_id = d.id
						LEFT JOIN faculities as f ON  d.faculity_id = f.id 
						LEFT JOIN V_STUDENT_LEVELS as sl ON s.id = sl.student_id
						LEFT JOIN V_STUDENT_FEES as fees ON s.id = fees.student_id
						LEFT JOIN users as register ON s.created_by = register.id
						LEFT JOIN users as updator ON s.created_by = updator.id
						');
    }

    public function down()
    {
        DB::statement('DROP VIEW V_STUDENT_REPORTS');
        DB::statement('DROP VIEW V_STUDENT_LEVELS');
        DB::statement('DROP VIEW V_STUDENT_FEES ');
    }

}
