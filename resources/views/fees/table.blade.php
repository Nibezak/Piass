   @if(!$students->isEmpty())
                  <table class="table table-striped">
                    <tbody><tr>
        						<th>names </th>
        						<th>gender </th>
        						<th>NID </th>
        						<th>Phone </th>
        						<th>E-Mail </th>
                    <th>Balance </th>
        						<th><i class="fa fa-gear"></i> </th>
                    </tr>
					@foreach($students as $student)
                    <tr>
                      <td>{{ $student->names }}</td>
                      <td>{{ $student->gender }}</td>
                      <td>{{ $student->NID }}</td>
                      <td>{{ $student->telephone }}</td>
                      <td>{{ $student->email }}</td>
                      <td>{{ $student->balance() }}</td>
                      <td><a href="{{route('fees.show',$student->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-money"></i> Register Fee</a></td>
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