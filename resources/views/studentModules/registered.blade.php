<div class="col-md-6">
	              <!-- general form elements disabled -->
  <div class="box box-warning">
    <div class="box-header">
      <h3 class="box-title">Registered modules so far</h3>
    </div><!-- /.box-header -->
		    <div class="box-body">
		 <table class="table table-striped" >
			<thead>
			<tr>
				<th>Name </th>
				<th>Code </th>
				<th>Credits </th>
				<th>Total Costs</th>
			</tr>
		   </thead>

		   <tbody >
		   	 @if($modules = $student->registeredModules)

			    @foreach($modules as $module)
					<tr>
						<td>{!! $module->name !!} </td>
						<td>{!! $module->code !!} </td>
						<td>{!! $module->credits !!} </td>
						<td>{!! $module->amount !!}</td>
					  <td>
					  {!! Form::open(['method'=>'delete','route'=>['students.modules.destroy',$module->id]]) !!}
					  	<button class="btn btn-danger" onclick="return confirm('Are you sure you want to remove module {{ $module->name }} from this student? this action cannot be reverted');">
						  	<i class="fa fa-times"></i>
					  	</button>
					  {!! Form::close() !!}
					  </td>
					</tr>
				@endforeach
		   	 @endif
		   </tbody>
		 </table>
		</div>
	</div>
</div>