<div class="col-md-6">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title" style="font-weight:600">Register modules </h3>
                  <h4>Mode of study: <em>{!! $student->mode_of_study !!}</em> Session: <em>{!! $student->session !!}</em> </h4>
                  
                </div><!-- /.box-header -->
                <div class="box-body">
                    
                      <div class="form-group {!! ($errors->has('faculity')) ? 'has-error' : '' !!}">
                       {!! Form::label('faculity', 'Choose the faculity ') !!}

                       {!! Form::select('faculity',$faculities,null, ['class'=>'form-control','id'=>'faculities']) !!}
                       {!! $errors->first('faculity','<label class="has-error">:message</label>') !!} 
                    </div>

                     <div id="department_section"style="display:none;">
                       {!! Form::label('Departments', 'Choose department') !!}
                        
                      <select id="departments" class="form-control">
                          
                      </select>
                      
                     </div>
                      
                    <div  id="department_level" style="display:none;">
                       {!! Form::label('level', 'Level') !!}
                        
                      <select id="departmentlevel" class="form-control">
                          
                      </select>

                    </div>

                    @include('studentModules.moduletable')
                    <!-- text input -->

                   <div class="box-footer" style="display:none" id="button">
                    {!! Form::submit($button, ['class'=>'btn btn-success']) !!}
                  </div>
            
                </div><!-- /.box-body -->
              </div><!-- /.box -->
           </div>
 </div>