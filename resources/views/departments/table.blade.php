   @if(!$departments->isEmpty())
                  <table class="table table-striped">
                    <tbody>
                    <tr>
                    <th># </th>
        						<th>Name </th>
        						<th>Descirption </th>
                    <th>Faculity </th>
        						<th>Count of Modules </th>
        						<th><i class="fa fa-gear"></i> </th>
                    </tr>
					@foreach($departments as $department)
                    <tr>
                      <td>{{ $department->id }}</td>
                      <td>{{ $department->name }}</td>
                      <td>{{ $department->descriptions }}</td>
                      <td>{{ $department->faculity->name }}</td>
                      <td>{{ $department->modules->count() }}</td> 

                      <td>
                       
                        {!! Form::open(['route' => ['settings.departments.destroy', $department->id], 'method' => 'delete']) !!}
                         <a href="{{route('settings.departments.edit',$department->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i>Edit</a>
                               <button type="submit" onclick="return confirm('Are you sure you want to delete {!! $department->name !!} department ?');"class="btn btn-danger btn-mini"><i class="fa fa-remove"></i> Delete</button>
                        {!! Form::close() !!}
                        
                      </td>
                    </tr>
					@endforeach
                  </tbody>
              </table>
               <div class="box-tools row">
                   <div class="col-md-6">
                    {!! $departments->render() !!}
                  </div>
              </div>
    @else
        We have no record of departments at the moment
    @endif