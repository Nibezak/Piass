@extends('layouts.default')

@section('title')
Student details report  
@stop
@section('description')
@include('reports.rightmenu')
@stop

@section('content')
   <div class="box">
	
	
	<div class="col-md-12">
	{!! Form::open(['route'=>'reports.students.details','method'=>'GET']) !!}
			@include('reports.students.filter')
	{!! Form::close() !!}
	</div>

	
	
	 {!! $table !!}
	 
	</div>
@stop