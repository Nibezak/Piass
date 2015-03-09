   @if(!$modules->isEmpty())
                  <table class="table table-striped">
                    <tbody>
                    <tr>
        						<th>Name </th>
        						<th>Code </th>
                    <th>Credits </th>
        						<th>Cost per Credit </th>
                    <th>Amount </th>
                    <th>Department Level </th>
        						<th><i class="fa fa-gear"></i> </th>
                    </tr>
					@foreach($modules as $module)
                    <tr>
                      <td>{{ $module->name }}</td>
                      <td>{{ $module->code }}</td>
                      <td>{{ $module->credits }}</td>
                      <td>{{ $module->credit_cost }}</td> 
                      <td>{{ $module->amount }}</td> 
                      <td>{{ $module->department_level }}</td> 
                      <td>
                       
                        {!! Form::open(['route' => ['modules.destroy', $module->id], 'method' => 'delete']) !!}
                         <a href="{{route('modules.edit',$module->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i>Edit</a>
                               <button type="submit" onclick="return confirm('Are you sure you want to delete {!! $module->name !!} module ?');"class="btn btn-danger btn-mini"><i class="fa fa-remove"></i> Delete</button>
                        {!! Form::close() !!}
                        
                      </td>
                    </tr>
					@endforeach
                  </tbody>
              </table>
               <div class="box-tools row">
                   <div class="col-md-6">
                    {!! $modules->render() !!}
                  </div>
              </div>
    @else
        We have no record of modules at the moment
    @endif