@extends('layouts.default')

@section('title')
 Register programme details for  {!! $student->names !!}
@stop

@section('description')
Fill below fields details about the programme you want to register for  {!! $student->names !!}.
@stop

@section('content')
	
		@include('students.profile')
		
		{!! Form::open(['route'=>'students.modules.store','onsubmit'=>'myButton.disabled = true; return true;']) !!}

		    {!! Form::hidden('student_id', $student->id) !!}

			@include('studentModules.form',['button'=>'Register Level'])
		
		{!! Form::close() !!}
@stop