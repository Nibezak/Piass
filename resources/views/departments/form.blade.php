<div class="col-md-6">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Register new department</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    
                  <div class="form-group {!! ($errors->has('faculity')) ? 'has-error' : '' !!}">
                       {!! Form::label('faculity', 'Faculity this department belongs to ') !!}

                       {!! Form::select('faculity',$faculities ,$department->faculity_id, ['class'=>'form-control']) !!}
                       {!! $errors->first('faculity','<label class="has-error">:message</label>') !!} 
                    </div>
                    <!-- text input -->

                    <div class="form-group {!! ($errors->has('name')) ? 'has-error' : '' !!}">
                      {!! Form::label('name', 'Department Name') !!}
                      {!! Form::text('name', $department->name, ['class'=>'form-control']) !!}
                      {!! $errors->first('name','<label class="has-error">:message</label>') !!} 
                    </div>

                    <div class="form-group {!! ($errors->has('levels')) ? 'has-error' : '' !!}">
                      {!! Form::label('levels', 'Department levels') !!}
                      {!! Form::text('levels', $department->levels, ['class'=>'form-control']) !!}
                      {!! $errors->first('levels','<label class="has-error">:message</label>') !!} 
                    </div>

                    <div class="form-group {!! ($errors->has('description')) ? 'has-error' : '' !!}">
                       {!! Form::label('description', 'Department Description') !!}

                       {!! Form::textarea('description', $department->descriptions, ['class'=>'form-control']) !!}
                       {!! $errors->first('description','<label class="has-error">:message</label>') !!} 
                    </div>

                   <div class="box-footer">
                    {!! Form::submit($button, ['class'=>'btn btn-success']) !!}
                  </div>
            
                </div><!-- /.box-body -->
              </div><!-- /.box -->
           </div>
 </div>