     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading user-panel">
              <h3 class="panel-title">{!! $student->names!!}</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-4 col-lg-4 " align="center">
                  <div class="img-circle" alt="Student Image" align="center">
                      
                      <i class="fa fa fa-graduation-cap" style="font-size:100px;"></i>

                  </div>
      <div class="col-xs-10 col-sm-10"> <br>
                  <dl style="text-align:left">
                   <dt>Campus </dt>
                    <dd>{!! $student->campus !!}</dd>
                   
                    <dt>Registration number </dt>
                    <dd>{!! $student->registration_number !!}</dd>
                    <dt>Study session</dt>
                    <dd>{!! $student->mode_of_study !!}</dd>
                     <dt>Study session</dt>
                    <dd>{!! $student->session !!}</dd>
                     <dt>Gender</dt>
                    <dd>{{$student->gender}}</dd>
                  </dl>
                </div>
                </div>
                
          
                <div class=" col-md-8 col-lg-8 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <th>Department:</th>
                        <td>{!! $student->department ? $student->department->name : 'N/A' !!}</td>
                      </tr>
                      <tr>
                        <th>Registration date:</th>
                        <td>{!! date('d-M-Y',strtotime($student->created_at)) !!}</td>
                      </tr>
                      <tr>
                        <th>Date of Birth:</th>
                        <td>{!! date('d-M-Y',strtotime($student->gender)) !!}</td>
                      </tr>
                      <tr>
                        <tr>
                        <th>Gender:</th>
                        <td>{!! $student->gender !!}</td>
                      </tr>
                        <tr>
                        <th>Nationality:</th>
                        <td>{!! $student->nationality !!}</td>
                      </tr>
                      <tr>
                        <th>Email:</th>
                        <td><a href="mailto:{!! $student->nationality !!}">{!! $student->email !!}</a></td>
                      </tr>
                      <tr>
                        <th>Phone Number:</th>
                        <td>{!! $student->telephone !!}</td>
                      </tr>
                      <tr>
                        <th>National ID:</th>
                        <td>{!! $student->NID !!}</td>
                      </tr>
                      <tr>
                        <th>Residence:</th>
                        <td>{!! $student->residence !!}</td>
                      </tr>
                    <tr>
                        <th>Occupation:</th>
                        <td>{!! $student->occupation !!}</td>
                      </tr>
                    </tbody>
                  </table>
                  
                  <a href="{{ route('student.registered.modules',$student->id)}}" class="btn btn-success"><i class="fa fa-line-chart"></i>Registered modules</a>
                  <a href="{{ route('student.fees',$student->id)}}" class="btn btn-primary">
                    <i class="fa fa-folder-o"></i> View my fees
                    </a>
                </div>
              </div>
            </div>
          </div>
    </div>