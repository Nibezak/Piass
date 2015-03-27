<div class="col-md-6">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title" style="font-weight:600">Faculity of 
                  {!! isset($student->department->faculity)?$student->department->faculity->name:'Not Available' !!}, 
                  department of  {!! isset($student->department->faculity)?$student->department->name:'Not Available' !!} </h3>

                  <h4>Mode of study: <em>{!! $student->mode_of_study !!}</em> Session: <em>{!! $student->session !!}</em> </h4>
                  
                </div><!-- /.box-header -->
                <div class="box-body">
                    
                    {{--  <div class="form-group {!! ($errors->has('faculity')) ? 'has-error' : '' !!}">
                       {!! Form::label('faculity', 'Choose the faculity ') !!}

                       {!! Form::select('faculity',$faculities,null, ['class'=>'form-control','id'=>'faculities']) !!}
                       {!! $errors->first('faculity','<label class="has-error">:message</label>') !!} 
                    </div>
 --}}
                     <div id="department_section" >
                       {!! Form::label('Departments', 'Department') !!}
                        
                       {!! Form::select('department',$departments,$student->department_id, 
                                       ['class'=>'form-control','id'=>'departments','disabled'=>true]) !!}
                      </select>
                      
                     </div>
                      
                    <div  id="department_level" style="display:none;">
                       {!! Form::label('level', 'Choose level') !!}
                        
                      <select id="departmentlevel" class="form-control">
                          
                      </select>

                    </div>

                    @include('studentModules.moduletable')
                    <!-- text input -->

                   <div class="box-footer" style="display:none" id="button">
                    {!! Form::submit($button, ['class'=>'btn btn-success','onclick'=>'Are you sure you want to register this modules to '.$student->name.' ? this action cannot be undone']) !!}
                  </div>
            
                </div><!-- /.box-body -->
              </div><!-- /.box -->
           </div>
 </div>