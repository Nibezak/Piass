<div class="col-md-6">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Register Fees or Arrears </h3> <label class="label pull-right bg-primary" style="font-size:22px;">Balance: {!! $student->balance() !!}</label>
                </div><!-- /.box-header -->
                <div class="box-body">
                    
                    <div class="form-group {!! ($errors->has('credit')) ? 'has-error' : '' !!}">
                      {!! Form::label('Type', 'Transaction Type') !!}
                      {!! Form::select('transaction_type',['credit' => 'Credit','debit'=>'Debit(Arrears before)'], 'credit', ['class'=>'form-control transaction-type']) !!}
                      {!! $errors->first('transaction_type','<label class="has-error"><i class="fa fa-times-circle-o"></i>:message</label>') !!} 
                    </div>
                    {!!Form::hidden('student_id', $student->id) !!}
                    <!-- text input -->
                    <div class="form-group {!! ($errors->has('credit')) ? 'has-error' : '' !!}">
                      {!! Form::label('Amount', 'Amount') !!}
                      {!! Form::input('number','credit', null, ['class'=>'form-control']) !!}
                      {!! $errors->first('credit','<label class="has-error"><i class="fa fa-times-circle-o"></i>:message</label>') !!} 
                    </div>
                    <div class="form-group {!! ($errors->has('payslip_number')) ? 'has-error' : '' !!} payslip_number">
                       {!! Form::label('payslip_number', 'Pay Slip') !!}

                       {!! Form::text('payslip_number', null, ['class'=>'form-control']) !!}
                       {!! $errors->first('payslip_number','<label class="has-error"><i class="fa fa-times-circle-o"></i>:message</label>') !!} 
                    </div>

                    <div class="form-group {!! ($errors->has('date')) ? 'has-error' : '' !!}">
                       {!! Form::label('date', 'Date') !!}

                       {!! Form::text('date', null, ['class'=>'form-control','id'=>'date']) !!}
                       {!! $errors->first('date','<label class="has-error"><i class="fa fa-times-circle-o"></i>:message</label>') !!} 
                    </div>

                    <!-- textarea -->
                    <div class="form-group {!! ($errors->has('description')) ? 'has-error' : '' !!}">
                      <label>Description</label>
                      <textarea name="description" class="form-control" rows="4" placeholder="Enter ..."></textarea>
                      {!! $errors->first('description','<label class="has-error"><i class="fa fa-times-circle-o"></i>:message</label>') !!} 
                    </div>
                   <div class="box-footer">
                    {!! Form::submit('Register fee', ['class'=>'btn btn-success']) !!}
                  </div>
            
                </div><!-- /.box-body -->
              </div><!-- /.box -->
           </div>
 </div>

 @section('footer')
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('.transaction-type').change(function(event) {
        var value = $(this).val();

        // If the user has selected debit
        // then hide the rest
        if(value == 'debit'){
          $('.payslip_number').hide();
          return;
        }

        // This is not for debit
        // then show the payslip feature
        $('.payslip_number').show();
      });
    });
  </script>
 @endsection