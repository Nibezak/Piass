   @if(!$students->isEmpty())
      <table class="table table-striped">
                    <tbody>
                    <tr>
        						<th>names </th>
                    <th>DOB </th>
                    <th>Gender </th>
                    <th>NID </th>
        						<th>Phone </th>
        						<th>E-Mail </th>        
                    <th>Faculity</th>
        						<th>Department </th>
                    <th>Class / Level </th>
                    </tr>
					@foreach($students as $student)
          
          <!-- IF STUDENT LEVEL DOESN'T MATCH go to next-->
           @if(\Input::get('level') && $student->level()!=\Input::get('level'))
            <?php continue; ?>
           @endif
                    <tr>
                      <td>{!! $student->names   !!}</td>
                      <td>{!! date('d-M-Y',strtotime($student->DOB ))  !!}</td>
                      <td>{!! $student->gender   !!}</td>
                      <td>{!! $student->NID   !!}</td>
                      <td>{!! $student->telephone   !!}</td>
                      <td>{!! $student->email   !!}</td>
                      <td>{!! $student->department->faculity->name !!}</td>
                      <td>{!! $student->department->name !!}</td>
                      <td>{!! $student->level() !!}</td>
                    </tr>
					@endforeach
                  </tbody>
              </table>
               <div class="box-tools row">
                   <div class="col-md-6">

                  </div>
              </div>
    @else
We have no record of students at the moment
    @endif