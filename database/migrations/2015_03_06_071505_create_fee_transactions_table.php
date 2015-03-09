<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeeTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fee_transactions', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->decimal('debit',10,2);
			$table->decimal('credit',10,2);
			$table->decimal('balance',10,2);
			$table->string('description');
			$table->string('payslip_number');
			$table->string('receipt_number');
			$table->timestamp('date');
			$table->integer('student_id')->unsigned();
			$table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
			$table->integer('done_by')->unsigned()->references('id')->on('users');
			$table->foreign('done_by')->references('id')->on('users')->onDelete('cascade');
			
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
		Schema::drop('fee_transactions');
	}

}
