     <div class="col-xs-12 col-sm-12 col-md-8 col-lg-7" >
          <div class="panel panel-info">

            <div class="panel-body">
              <div class="row">
                <div class="col-md-5 col-lg-5 ">

                  <div class="img-circle" alt="Student Image" align="center">
                      
                      <i class="fa fa fa-graduation-cap" style="font-size:100px;"></i>

                  </div>
      <div class="col-xs-10 col-sm-10 "> <br>
                  <dl>
                    <dt>Residence <em style="font-size:12px;font-weight:100">(Sector, District...)</em>
                      {!! $errors->first('residence','<em class="has-error">(:message)</em>') !!} 
                    </dt>
                    <dd class=" {{ ($errors->has('residence')) ? 'has-error' : '' }}">
                     {!! Form::text('residence', $student->residence, ['class'=>'form-control','placeholder'=>'residence ']) !!}
                  </dd>
                    <dt>Occupation
                     {!! $errors->first('occupation','<em class="has-error">(:message)</em>') !!} 
                    </dt>
                    <dd class=" {{ ($errors->has('occupation')) ? 'has-error' : '' }}">
                       {!! Form::text('occupation', $student->occupation, ['class'=>'form-control','placeholder'=>'Occupation ']) !!}
                    </dd>
                    <dt>Father's name
                     {!! $errors->first('father_name','<em class="has-error">(:message)</em>') !!} 
                    </dt>
                    <dd class=" {{ ($errors->has('father_name')) ? 'has-error' : '' }}">
                       {!! Form::text('father_name', $student->father_name, ['class'=>'form-control','placeholder'=>'Father\'s names ']) !!}
                    </dd>
                    <dt>Mother's name
                     {!! $errors->first('mother_name','<em class="has-error">(:message)</em>') !!} 
                    </dt>
                    <dd class=" {{ ($errors->has('mother_name')) ? 'has-error' : '' }}">
                        {!! Form::text('mother_name', $student->mother_name, ['class'=>'form-control','placeholder'=>'Mother\'s names ']) !!}
                    </dd>
                   <dt>Campus
                     {!! $errors->first('Campus','<em class="has-error">(:message)</em>') !!} 
                    </dt>
                    <dd class=" {{ ($errors->has('Campus')) ? 'has-error' : '' }}">
                        {!! Form::select('campus',['Huye'=>'Huye','Karongi'=>'Karongi'], $student->campus, ['class'=>'form-control','placeholder'=>'Campus']) !!}
                    </dd>
                    <dt>Study mode
                     {!! $errors->first('mode_of_study','<em class="has-error">(:message)</em>') !!} 
                    </dt>
                    <dd class=" {{ ($errors->has('mode_of_study')) ? 'has-error' : '' }}">
                       {!! Form::select('mode_of_study',['Full time'=>'Full time','Part time'=>'Part time','Holidays'=>'Holidays'],$student->mode_of_study) !!}
                       {!! Form::select('session',['Day'=>'Day','Evening'=>'Evening','Weekend'=>'Weekend'],$student->session) !!}
                    </dd>
                  </dl>
                </div>

                </div>
                
          
                <div class=" col-md-7 col-lg-7 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <th>Names:
                          {!! $errors->first('names','<em class="has-error">(:message)</em>') !!} 
                        </th>
                        <td class=" {{ ($errors->has('names')) ? 'has-error' : '' }}"> 
                          {!! Form::text('names', $student->names, ['class'=>'form-control','placeholder'=>'Enter student names']) !!}
                           </td>
                      </tr>
                     
                      <tr>
                        <th>Date of Birth:
                        {!! $errors->first('DOB','<em class="has-error">(:message)</em>') !!} 
                        </th>
                        <td class=" {{ ($errors->has('DOB')) ? 'has-error' : '' }}">
                          {!! Form::text('DOB',date('Y-m-d',strtotime($student->DOB)),['class'=>'form-control','id'=>'date','data-inputmask'=>'\'alias\':\'dd-mm-yyyy\'']) !!}</td>
                      </tr>
                      <tr>
                        <tr>
                        <th>Gender:
                      {!! $errors->first('gender','<em class="has-error">(:message)</em>') !!} 
                        </th>
                        <td class=" {{ ($errors->has('gender')) ? 'has-error' : '' }}">
                           {!! Form::select('gender',['Male'=>'Male','Female'=>'Female'],$student->gender, ['class' => 'form-control']) !!}
                        </td>
                      </tr>
                      <tr>
                        <th>Martial status:
                           {!! $errors->first('martial_status','<em class="has-error">(:message)</em>') !!} 
                        </th>
                        <td class=" {{ ($errors->has('martial_status')) ? 'has-error' : '' }}">
                          {!! Form::select('martial_status',['Single'=>'Single','Married'=>'Married'],$student->martial_status, ['class' => 'form-control']) !!}
                        </td>
                      </tr>
                       <tr>
                        <th>National ID:
                        {!! $errors->first('NID','<em class="has-error">(:message)</em>') !!} 
                        </th>
                        <td class=" {{ ($errors->has('NID')) ? 'has-error' : '' }}">
                        {!! Form::text('NID', $student->NID, ['class'=>'form-control','placeholder'=>'Enter student national ID']) !!}
                        </td>
                      </tr>
                        <tr>
                        <th>Nationality:
                          {!! $errors->first('nationality','<em class="has-error">(:message)</em>') !!} 
                        </th>
                        <td class=" {{ ($errors->has('nationality')) ? 'has-error' : '' }}">
                          {!! Form::text('nationality', $student->nationality, ['class'=>'form-control','placeholder'=>'Nationality ']) !!}</td>
                      </tr>
                      <tr>
                        <th>Email:
                         {!! $errors->first('email','<em class="has-error">(:message)</em>') !!} 
                        </th>
                        <td class=" {{ ($errors->has('email')) ? 'has-error' : '' }}">
                           {!! Form::input('email','email', $student->email, ['class'=>'form-control email','placeholder'=>'Email  address']) !!}
                        </td>
                      </tr>
                      <tr>
                        <th>Phone Number:
                         {!! $errors->first('telephone','<em class="has-error">(:message)</em>') !!} 
                        </th>
                        <td class=" {{ ($errors->has('telephone')) ? 'has-error' : '' }}">
                          
                          {!! Form::text('telephone', $student->telephone, ['class'=>'form-control','placeholder'=>'Telephone or Mobile']) !!}
                        </td>
                      </tr>
                      <tr>
                        <th>Departments:
                         {!! $errors->first('department_id','<em class="has-error">(:message)</em>') !!} 
                        </th>
                        <td class=" {{ ($errors->has('department_id')) ? 'has-error' : '' }}">
                          
                          {!! Form::select('department_id', $departments, $student->department_id, ['class'=>'form-control']) !!}
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  
                 @if(isset($student->id))
                     <a href="{!! route('students.modules.show',$student->id) !!}" class="btn btn-success">
                     <i class="fa fa-book"></i> Register modules
                     </a>
                  @endif
                  <a href="{!!route('students.index')!!}" class="btn btn-warning"><i class="fa fa-remove"></i> Cancel</a>
                  <button href="#" class="btn btn-primary"><i class="fa fa-floppy-o"></i> {!! $button !!}</button>

                </div>
              </div>
            </div>
          </div>
            </div>
    </div>