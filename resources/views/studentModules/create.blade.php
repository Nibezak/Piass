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
			@include('studentModules.form',['button'=>'Register Level'])
		{!! Form::close() !!}
@stop