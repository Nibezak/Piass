

<div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Monthly Recap Report</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <div class="btn-group">
                      <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                      </ul>
                    </div>
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
				 
				 <?php  $debit=0; $credit= 0;?>
					@foreach($student->fees as $fee)
					<tr>
					  <td> {!! $fee->payslip_number !!}</td>
					  <td> {!! date('Y-m-d',strtotime($fee->date)) !!}</td>
					  <td> {!! $fee->description !!}</td>
					  <td> {!! $debit+=$fee->debit !!}</td>
					  <td> {!! $credit+=$fee->credit !!}</td>
					  <td> {!! $fee->balance !!}</td>
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