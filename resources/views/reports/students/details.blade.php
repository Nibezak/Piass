@extends('layouts.default')

@section('title')
<a href="{!! $_SERVER['REQUEST_URI'] !!}&export=1" class="btn btn-sm btn-success"> <i class="fa fa-excel-o"> </i>Export </a>
@stop

@section('content')

	<div class="row">
	
	<div class="col-md-9">
	{!! Form::open(['route'=>'reports.students.details','method'=>'GET']) !!}
			@include('reports.students.filter')
	{!! Form::close() !!}
	
	 @include('reports.students.table')
	</div>
	
	 <div class="col-md-3">
      @include('reports.rightmenu')
    </div>
		
	</div>
@stop