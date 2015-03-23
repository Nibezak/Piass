   @if(!empty($students))


      <table class="table table-striped">
                    <tbody>
                    <tr>
        						<th>names </th>
        						<th>Phone </th>
        						<th>E-Mail </th>        
                    <th>Faculity</th>
        						<th>Department </th>
                    <th>Class / Level </th>
                    <th>Debit</th>
                    <th>Credit </th>
                    <th> Balance </th>
                    <th> Progress </th>
                    </tr>
					@foreach($students as $student)

               @if(empty($student))
                 <?php continue ?>
                @endif
                   <tr>
                      <td>{!! $student['Names']   !!}</td>
                      <td>{!! $student['Telephone']   !!}</td>
                      <td>{!! $student['Email']   !!}</td>
                      <td>{!! $student['Faculity'] !!}</td>
                      <td>{!! $student['Department'] !!}</td>
                      <td>{!! $student['Class / Level'] !!}</td>
                      <td>{!! number_format($student['Amount to pay']) !!}</td>
                      <td>{!! number_format($student['Amount Paid so far']) !!}</td>
                      <td>{!! number_format($student['balance']) !!} </td>
                      <td><div class="progress-bar progress-bar-{!! $student['severity'] !!}" style="width:{!! $student['Payment progresss'] !!}"></div>
                      <span class="badge text-{!! $student['severity'] !!}">width:{!! $student['Payment progresss'] !!}</span> </td>
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