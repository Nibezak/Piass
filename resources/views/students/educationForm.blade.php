 {!! Form::hidden('student_id', $student->id) !!}
 <table class="table table-user-information">
        <tbody>
          <tr>
            <th>Qualification:
              {!! $errors->first('qualification','<em class="has-error">(:message)</em>') !!} 
            </th>
            <td class=" {{ ($errors->has('qualification')) ? 'has-error' : '' }}"> 
              {!! Form::select('qualification', ['A0'=>'A0','A1'=>'A1','A2'=>'A2'], $student->qualification,['class'=>'form-control']) !!}
               </td>
          </tr>
                    <tr>
          <th>School attended:
              {!! $errors->first('subject1','<em class="has-error">(:message)</em>') !!} 
            </th>
            <td class=" {{ ($errors->has('subject1')) ? 'has-error' : '' }}"> 
              <div class="pull-left">
                     {!! Form::label('name', 'School name',['style'=>'font-weight:200']) !!}
                      {!! Form::text('school_attended',$student->educations ?$student->educations->school_attended:null, ['class'=>'form-control']) !!}
              </div>
              <div class="pull-right">
                      {!! Form::label('name', 'Year',['style'=>'font-weight:200']) !!}
                      {!! Form::selectYear('completion_year',2000,date('Y',strtotime('-1 year')),$student->educations ?$student->educations->completion_year:null,['class'=>'form-control'])!!} 
             </div>
       </td>
          </tr>
          <tr>
          <th>Section of study:
              {!! $errors->first('subject1','<em class="has-error">(:message)</em>') !!} 
            </th>
            <td class=" {{ ($errors->has('subject1')) ? 'has-error' : '' }}"> 
            {!! Form::text('section_of_study',$student->educations ? $student->educations->section_of_study:null,['class'=>'form-control']) !!}     
         </td>
          </tr>
          <tr>
          <th>Subject 1:
              {!! $errors->first('subject1','<em class="has-error">(:message)</em>') !!} 
            </th>
            <td class=" {{ ($errors->has('subject1')) ? 'has-error' : '' }}"> 
              <div class="pull-left">
                     {!! Form::label('name', 'Name',['style'=>'font-weight:200']) !!}
                     {!! Form::text('subject[]',($student->educations)?$student->educations->subjectsNames()->subject1:NULL, ['class'=>'form-control']) !!}
              </div>
              <div class="pull-right">
                      {!! Form::label('name', 'Grade',['style'=>'font-weight:200']) !!}
                      {!! Form::select('grade[]', ['A'=>'A','B'=>'B','C'=>'C','D'=>'D','E'=>'E'],NULL,['class'=>'form-control']) !!}
              </div>
		   </td>
          </tr>
          <tr>
          <th>Subject 2:
              {!! $errors->first('subject1','<em class="has-error">(:message)</em>') !!} 
            </th>
            <td class=" {{ ($errors->has('subject1')) ? 'has-error' : '' }}"> 
              <div class="pull-left">
                     {!! Form::label('name', 'Name',['style'=>'font-weight:200']) !!}
                      {!! Form::text('subject[]',($student->educations)?$student->educations->subjectsNames()->subject2:NULL, ['class'=>'form-control']) !!}
              </div>
              <div class="pull-right">
                      {!! Form::label('name', 'Grade',['style'=>'font-weight:200']) !!}
                      {!! Form::select('grade[]', ['A'=>'A','B'=>'B','C'=>'C','D'=>'D','E'=>'E'], ($student->educations)?$student->educations->subjectsGrades()->grade1:NULL,['class'=>'form-control']) !!}
              </div>
		   </td>
          </tr>
                    <tr>
          <th>Subject 3:
              {!! $errors->first('subject1','<em class="has-error">(:message)</em>') !!} 
            </th>
            <td class=" {{ ($errors->has('subject1')) ? 'has-error' : '' }}"> 
              <div class="pull-left">
                     {!! Form::label('name', 'Name',['style'=>'font-weight:200']) !!}
                      {!! Form::text('subject[]',($student->educations)?$student->educations->subjectsNames()->subject3:NULL, ['class'=>'form-control']) !!}
              </div>
              <div class="pull-right">
                      {!! Form::label('name', 'Grade',['style'=>'font-weight:200']) !!}
                      {!! Form::select('grade[]', ['A'=>'A','B'=>'B','C'=>'C','D'=>'D','E'=>'E'], ($student->educations)?$student->educations->subjectsGrades()->grade3:NULL,['class'=>'form-control']) !!}
              </div>
		   </td>
          </tr>
          <tr>
          <th>Subject 4:
              {!! $errors->first('subject1','<em class="has-error">(:message)</em>') !!} 
            </th>
            <td class=" {{ ($errors->has('subject1')) ? 'has-error' : '' }}"> 
              <div class="pull-left">
                     {!! Form::label('name', 'Name',['style'=>'font-weight:200']) !!}
                      {!! Form::text('subject[]',($student->educations)?$student->educations->subjectsNames()->subject4:NULL, ['class'=>'form-control']) !!}
              </div>
              <div class="pull-right">
                      {!! Form::label('name', 'Grade',['style'=>'font-weight:200']) !!}
                      {!! Form::select('grade[]', ['A'=>'A','B'=>'B','C'=>'C','D'=>'D','E'=>'E'], ($student->educations)?$student->educations->subjectsGrades()->grade4:NULL,['class'=>'form-control']) !!}
              </div>
		   </td>
          </tr>


        </tbody>
 </table>