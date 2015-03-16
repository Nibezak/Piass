<div class="col-md-6">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Register new department level</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    
                  <div class="form-group {!! ($errors->has('faculity')) ? 'has-error' : '' !!}">
                       {!! Form::label('faculity', 'Choose the faculity ') !!}

                       {!! Form::select('faculity',$faculities,null, ['class'=>'form-control']) !!}
                       {!! $errors->first('faculity','<label class="has-error">:message</label>') !!} 
                    </div>
                    <!-- text input -->

                   <div class="box-footer">
                    {!! Form::submit($button, ['class'=>'btn btn-success']) !!}
                  </div>
            
                </div><!-- /.box-body -->
              </div><!-- /.box -->
           </div>
 </div>