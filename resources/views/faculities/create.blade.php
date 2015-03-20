@extends('layouts.default')

@section('title')
Add new faculity
@stop

@section('description')
Fill below fields and click save to add new faculity
@stop


@section('content')
<div class="box">
      
{!! Form::open(['route' => 'settings.faculities.store']) !!}       

	@include('faculities.form',['button'=>'Register faculity'])
	
{!! Form::close() !!}
</div>

@stop