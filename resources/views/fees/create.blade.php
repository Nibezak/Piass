@extends('layouts.default')

@section('title')
 {!! $student->names !!}
@stop

@section('description')
Below are the details for {!! $student->names !!} as of now.
@stop

@section('content')
	
		@include('students.profile')
		
		{!! Form::open(['route'=>'fees.store']) !!}
			@include('fees.form')
		{!! Form::close() !!}
@stop