@extends('layouts.default')

@section('title')
Add new departement
@stop

@section('description')
Fill below fields and click save to add new departement
@stop


@section('content')
<div class="box">
      
{!! Form::open(['route' => 'settings.departments.store']) !!}       

	@include('departments.form',['button'=>'Register departement'])
	
{!! Form::close() !!}
</div>

@stop