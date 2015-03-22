   @if(!$students->isEmpty())
      <table class="table table-striped">
                    <tbody><tr>
        						<th>names </th>
        						<th>Date of Birth </th>
        						<th>Gender </th>
        						<th>Martial </th>
        						<th>NID </th>
        						<th>Phone </th>
        						<th>E-Mail </th>
        						<th>Occupation </th>
                    </tr>
					@foreach($students as $student)
                    <tr>
                      <td>{{ $student->names }}</td>
                      <td>{{ date('d-M-Y',strtotime($student->DOB ))}}</td>
                      <td>{{ $student->gender }}</td>
                   	  <td>{{ $student->martial_status }}</td>
                      <td>{{ $student->NID }}</td>
                      <td>{{ $student->telephone }}</td>
                      <td>{{ $student->email }}</td>
                      <td>{{ $student->occupation }}</td>
                     
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