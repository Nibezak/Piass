<div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"> {!! $student->names !!}'s fees transactions</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">

                    <div class="col-md-12">
                <table class="table table-striped">
				<thead>
					<tr class="box-body table-responsive no-padding">
					<th > Transaction/ Receipt Number </th>
					<th > Date       </th>
					<th > Description</th>
					<th > Debits DR  </th>
					<th > Credits CR </th>
					<th > Balance    </th>
					</tr>
				</thead>
				<tbody>
				@if($student->fees->count())

				 <?php $debit = 0;
$credit = 0;?>
					@foreach($student->fees as $fee)
					<?php $debit += $fee->debit;
$credit += $fee->credit?>
					<tr>
					  <td> {!! $fee->payslip_number?:$fee->id !!}</td>
					  <td> {!! date('Y-m-d',strtotime($fee->date)) !!}</td>
					  <td> {!! $fee->description !!}</td>
					  <td> {!! $fee->debit !!}</td>
					  <td> {!! $fee->credit !!}</td>
					  <td> {!! $fee->balance !!}</td>
					  <td>
					  {!! Form::open(['method'=>'delete','route'=>['fees.destroy',$fee->id]]) !!}
					  	<button class="btn btn-danger" onclick="return confirm('Are you sure you want to remove this fee from this student? this action cannot be reverted');">

						  	<i class="fa fa-times"></i>
					  	</button>
					  {!! Form::close() !!}
					  </td>
					</tr>
					@endforeach

					<tr style="border-top:1px solid #000;">
					<td colspan="3" align="right">  Grand Totals : </b></td>
					<td > <b> {!! $debit !!}</b> </td>
					<td > <b> {!! $credit !!}</b> </td>
					<td > <b> {!! $debit-$credit !!}</b></td>
				</tr>
				<tr>
                      <th >Closing Balance : {!! $student->balance() !!}</th>

                      <td colspan="4">
                        <div class="progress progress-xs progress-striped active">
                          <div class="progress-bar progress-bar-success" style="width:{!! ($debit==0) ? 0 :round(($credit*100)/$debit) !!}%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-green">{!! ($debit==0) ? 0 :round(($credit*100)/$debit) !!}%</span></td>
                    </tr>
				@else
				<tr >
					 <th colspan="6" align="center"> No transaction made so far </th>
				</tr>
				@endif
							</tbody>
				</table>
                    </div>
                  </div><!-- /.row -->
                </div><!-- /.box-footer -->
              </div>