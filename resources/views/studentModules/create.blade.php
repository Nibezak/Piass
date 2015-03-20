@extends('layouts.default')

@section('title')
 {!! $student->names !!}
@stop

@section('description')
Below are the details for {!! $student->names !!} as of now.
@stop

@section('content')
	
		@include('students.profile')
		
		{!! Form::open(['route'=>'students.modules.store']) !!}

		    {!! Form::hidden('student_id', $student->id) !!}

			@include('studentModules.form',['button'=>'Register Level'])
		
		{!! Form::close() !!}
@stop