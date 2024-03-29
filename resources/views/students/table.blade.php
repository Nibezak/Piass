   @if(!$students->isEmpty())
                  <table class="table table-striped">
                    <tbody><tr>
        						<th>names </th>
        						<th>Reg #</th>
        						<th>Campus </th>
                    <th>Faculity </th>
        						<th>Department </th>
        						<th>Level </th>
        						<th>InTake </th>
                    <th>Mode of Study</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Balance</th>
        						<th><i class="fa fa-gear"></i> </th>
                    </tr>
					@foreach($students as $student)

                    <tr>
                      <td>{{ isset($student->names)?$student->names:null }}</td>
                      <td>{{ isset($student->registration_number)?$student->registration_number:null }}</td>
                      <td>{{ isset($student->campus)?$student->campus:null }}</td>
                      <td>{{ $student->department->faculity->name}}</td>
                      <td>{{ $student->department->name}}</td>
                      <td>{{ $student->level() }}</td>
                      <td>{{ $student->inTake() }}</td>
                      <td>{{ isset($student->mode_of_study)?$student->mode_of_study:null }}</td>
                      <td>{{ number_format($student->totalDebitAmount()) }}</td>
                      <td>{{ number_format($student->totalCreditAmount()) }}</td>
                      <td>{{ number_format($student->balance()) }}</td>
                      <td>
                      <a href="{{route('student.fees',$student->id)}}" class="btn btn-sm btn-info"><i class="fa fa-exchange">Transactions</i>
                      </a>
                      <a href="{{route('students.modules.show',$student->id)}}" class="btn btn-sm btn-success"><i class="fa fa-book">Modules</i>
                      </a>
                      <a href="{{route('student.marks',$student->id)}}" class="btn btn-sm btn-success"><i class="fa fa-book">Marks</i>
                      </a>
                        <a href="{{route('fees.show',$student->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-money"></i>
                          Payment
                        </a>
                        <a href="{{route('students.edit',$student->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                         <a href="{{route('students.delete',$student->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete student {!! $student->names !!} ?');">
                         <i class="fa fa-cancel"></i> Delete
                         </a>
                         </td>
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