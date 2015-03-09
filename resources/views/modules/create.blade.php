@extends('layouts.default')

@section('title')
Add new module to level {!! $level !!} of {!! $department->name !!} deparatment
@stop

@section('description')
Fill below fields and click <strong>Register</strong> to add new module
@stop


@section('content')
<div class="box">
      
{!! Form::open(['route' => 'modules.store']) !!}       

	@include('modules.form',['button'=>'Register module'])
	
{!! Form::close() !!}
</div>

@stop