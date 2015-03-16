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
        						<th>Residence </th>
        						<th><i class="fa fa-gear"></i> </th>
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
                      <td>{{ $student->residence }}</td>
                      <td>
                      <a href="{{route('students.modules.show',$student->id)}}" class="btn btn-sm btn-success"><i class="fa fa-book">Courses</i>
                        
                      </a>
                        <a href="{{route('fees.show',$student->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-money"></i>
                          Fees
                        </a>
                        <a href="{{route('students.edit',$student->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Edit</a></td>
                    </tr>
					@endforeach
                  </tbody>
              </table>
               <div class="box-tools row">
                   <div class="col-md-6">
                    {!! $students->render() !!}
                  </div>
              </div>
    @else
We have no record of students at the moment
    @endif