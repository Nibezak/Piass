@extends('layouts.default')

@section('title')
Student details report
@stop

@section('content')

	<div class="row">
	
	<div class="col-md-9">
	{!! Form::open(['route'=>'reports.students.details','method'=>'GET']) !!}
			@include('reports.students.filter')
	{!! Form::close() !!}
	
	 {!! $table !!}
	</div>
	
	 <div class="col-md-3">
      @include('reports.rightmenu')
    </div>
		
	</div>
@stop