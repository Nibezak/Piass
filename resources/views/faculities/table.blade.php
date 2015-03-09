   @if(!$faculities->isEmpty())
                  <table class="table table-striped">
                    <tbody>
                    <tr>
                    <th># </th>
        						<th>Name </th>
        						<th>Descirption </th>
        						<th>Count of Departments </th>
        						<th><i class="fa fa-gear"></i> </th>
                    </tr>
					@foreach($faculities as $faculity)
                    <tr>
                      <td>{{ $faculity->id }}</td>
                      <td>{{ $faculity->name }}</td>
                      <td>{{ $faculity->description }}</td>
                      <td>{{ $faculity->departments->count() }}</td> 

                      <td>
                       
                        {!! Form::open(['route' => ['settings.faculities.destroy', $faculity->id], 'method' => 'delete']) !!}
                         <a href="{{route('settings.faculities.edit',$faculity->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i>Edit</a>
                               <button type="submit" onclick="return confirm('Are you sure you want to delete {!! $faculity->name !!} faculity ?');"class="btn btn-danger btn-mini"><i class="fa fa-remove"></i> Delete</button>
                        {!! Form::close() !!}
                        
                      </td>
                    </tr>
					@endforeach
                  </tbody>
              </table>
               <div class="box-tools row">
                   <div class="col-md-6">
                    {!! $faculities->render() !!}
                  </div>
              </div>
    @else
        We have no record of faculities at the moment
    @endif