<div class="col-md-6">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Register new module</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    

                    <!-- text input -->
                    @if($department && $level)
                      {!! Form::hidden('department_level', $level) !!}
                    
                    {!! Form::hidden('department_id', $department->id) !!}
                    @endif

                    <div class="form-group {!! ($errors->has('name')) ? 'has-error' : '' !!}">
                      {!! Form::label('name', 'module Name') !!}
                      {!! Form::text('name', $module->name, ['class'=>'form-control']) !!}
                      {!! $errors->first('name','<label class="has-error">:message</label>') !!} 
                    </div>

                    <div class="form-group {!! ($errors->has('code')) ? 'has-error' : '' !!}">
                      {!! Form::label('code', 'Module code') !!}
                      {!! Form::text('code', $module->code, ['class'=>'form-control']) !!}
                      {!! $errors->first('code','<label class="has-error">:message</label>') !!} 
                    </div>
                    
                    <div class="form-group {!! ($errors->has('credits')) ? 'has-error' : '' !!}">
                      {!! Form::label('credits', 'Module credits') !!}
                      {!! Form::input('number','credits', $module->credits, ['class'=>'form-control']) !!}
                      {!! $errors->first('credits','<label class="has-error">:message</label>') !!} 
                    </div>

                     <div class="form-group {!! ($errors->has('credit_cost')) ? 'has-error' : '' !!}">
                      {!! Form::label('credit_cost', 'Cost per credit') !!}
                      {!! Form::input('number','credit_cost', $module->credit_cost, ['class'=>'form-control']) !!}
                      {!! $errors->first('credit_cost','<label class="has-error">:message</label>') !!} 
                    </div>

                   <div class="box-footer">
                    {!! Form::submit($button, ['class'=>'btn btn-success','onclick'=>'return confirm(\'Are you sure you want to do this? this action cannot be reverted\')']) !!}
                  </div>
            
                </div><!-- /.box-body -->
              </div><!-- /.box -->
           </div>
 </div>