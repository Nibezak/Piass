@extends('layouts.default')

@section('title')
Add new module @if($department) to  level {!! $level !!} of {!! $department->name !!} deparatment @endif
@stop

@section('description')
Fill below fields and click <strong>Register</strong> to add new module
@stop


@section('content')
<div class="box">
      
{!! Form::open(['route' => 'modules.store','onsubmit'=>'myButton.disabled = true; return true;']) !!}       

	@include('modules.form',['button'=>'Register module'])
	
{!! Form::close() !!}
</div>

@stop