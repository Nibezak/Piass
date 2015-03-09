@extends('layouts.default')

@section('title')
Register new student
@stop

@section('description')
Please fill below fields in order to register new student
@stop


@section('content')
<div class="box">
      
{!! Form::open(['route' => 'students.store','file'=>true]) !!}       

	@include('students.form',['button'=>'Register'])
	
	@include('students.educations',['button'=>'Edit'])
{!!  Form::close() !!}     
	@include('students.files')
</div><!-- /.box-body -->

@stop