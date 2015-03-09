@extends(config('sentinel.layout'))

{{-- Web site Title --}}
@section('title')
Current Users
@stop

{{-- Content --}}
@section('content')

<div class="box">
                <div class="box-header">
                  <a class='btn btn-primary' href="{{ route('sentinel.users.create') }}">Create User</a>
                  <div class="box-tools">
                    <div class="input-group">
                      <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search">
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-success"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
<table class="table table-striped">
		<thead>
			<th>User</th>
			<th>Status</th>
			<th>Options</th>
		</thead>
		<tbody>
			@foreach ($users as $user)
				<tr>
					<td><a href="{{ action('Sentinel\UserController@show', array($user->hash)) }}">{{ $user->email }}</a></td>
					<td>{{ $user->status }} </td>
					<td>
						<button class="btn btn btn-sm  btn-info" type="button" onClick="location.href='{{ action('Sentinel\UserController@edit', array($user->hash)) }}'" >Edit</button> 
						@if ($user->status != 'Suspended')
							<button class="btn btn-sm btn-warning" type="button" onClick="location.href='{{ action('Sentinel\UserController@suspend', array($user->hash)) }}'">Suspend</button> 
						@else
							<button class="btn btn-sm " type="button" onClick="location.href='{{ action('Sentinel\UserController@unsuspend', array($user->hash)) }}'">Un-Suspend</button> 
						@endif
						
						<button class="btn btn btn-sm btn-danger" href="{{ action('Sentinel\UserController@destroy', array($user->hash)) }}" data-token="{{ Session::getToken() }}" data-method="delete">Delete</button>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	 </div><!-- /.box-body -->
              </div>
@stop