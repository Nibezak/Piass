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
                      {!! Form::select('grade[]', ['A'=>'A','B'=>'B','C'=>'C'],NULL,['class'=>'form-control']) !!}
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
                      {!! Form::select('grade[]', ['A'=>'A','B'=>'B','C'=>'C'], ($student->educations)?$student->educations->subjectsGrades()->grade1:NULL,['class'=>'form-control']) !!}
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
                      {!! Form::select('grade[]', ['A'=>'A','B'=>'B','C'=>'C'], ($student->educations)?$student->educations->subjectsGrades()->grade3:NULL,['class'=>'form-control']) !!}
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
                      {!! Form::select('grade[]', ['A'=>'A','B'=>'B','C'=>'C'], ($student->educations)?$student->educations->subjectsGrades()->grade4:NULL,['class'=>'form-control']) !!}
              </div>
		   </td>
          </tr>

          <tr>
          <th>School attended:
              {!! $errors->first('subject1','<em class="has-error">(:message)</em>') !!} 
            </th>
            <td class=" {{ ($errors->has('subject1')) ? 'has-error' : '' }}"> 
              <div class="pull-left">
                     {!! Form::label('name', 'School name',['style'=>'font-weight:200']) !!}
                      {!! Form::text('school_attended',$student->school_attended, ['class'=>'form-control']) !!}
              </div>
              <div class="pull-right">
                      {!! Form::label('name', 'Year',['style'=>'font-weight:200']) !!}
                      {!! Form::selectYear('completion_year',2000,date('Y',strtotime('-1 year')),$student->completion_year,['class'=>'form-control'])!!} 
             </div>
		   </td>
          </tr>
        </tbody>
 </table>