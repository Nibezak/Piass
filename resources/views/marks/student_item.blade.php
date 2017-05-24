{!! Form::open(array('route' => array('marks.update', $student->id), 'method' => 'PUT')) !!}
 <tr>
	<td>{!! $student->registration_number  !!}</td>
	<td>{!! $student->names  !!}</td>
	<td>{!! $student->faculity !!}</td>
	<td>{!! $student->department !!}</td>
	<td>{!! $student->level !!}
	<td>{!! $student->academicYear !!}</td>
	<td>{!! Form::text('cat',  $student->cat , ['class'=>'form-control','size'=>'3'])!!}</td>
	<td>{!! Form::text('exam',  $student->exam , ['class'=>'form-control','size'=>'3'])!!}</td>
	<td>
		{!! Form::hidden('student_id', $student->id) !!}
		<button  class="btn btn-primary">
			<i class="fa fa-edit"></i>
		</button>
	</td>
</tr>
{!! Form::close() !!}
