@extends('layouts.default')

@section('title')
Student  with pending payment reports

@stop

@section('content')

	<div class="row">
	
	<div class="col-md-9">
	{!! Form::open(['route'=>'reports.students.payments.pending','method'=>'GET']) !!}
			@include('reports.students.filter')
	{!! Form::close() !!}
	
	 @include('reports.students.tablepayment')
	</div>
	
	 <div class="col-md-3">
      @include('reports.rightmenu')
    </div>
		
	</div>
@stop