<div class="col-md-6">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Register new faculity</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
             
                    <!-- text input -->
                    <div class="form-group {!! ($errors->has('name')) ? 'has-error' : '' !!}">
                      {!! Form::label('name', 'Name') !!}
                      {!! Form::text('name', $faculity->name, ['class'=>'form-control']) !!}
                      {!! $errors->first('name','<label class="has-error">:message</label>') !!} 
                    </div>
                    <div class="form-group {!! ($errors->has('description')) ? 'has-error' : '' !!}">
                       {!! Form::label('description', 'Description') !!}

                       {!! Form::textarea('description', $faculity->description, ['class'=>'form-control']) !!}
                       {!! $errors->first('description','<label class="has-error">:message</label>') !!} 
                    </div
                  
                   <div class="box-footer">
                    {!! Form::submit($button, ['class'=>'btn btn-success']) !!}
                  </div>
            
                </div><!-- /.box-body -->
              </div><!-- /.box -->
           </div>
 </div>