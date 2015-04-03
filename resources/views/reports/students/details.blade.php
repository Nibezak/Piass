@extends('layouts.default')

@section('title')
{!! $header !!}  
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

	
	<div class="box-body">
	 {!! $table !!}
	</div>
	</div>
@stop
