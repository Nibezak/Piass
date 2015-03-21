@extends('layouts.default')

@section('title')
Register new student
@stop

@section('description')
Please fill below fields in order to register new student
@stop


@section('content')
<div class="box">
      
{!! Form::open(['route' => 'students.store']) !!}       

	@include('students.form',['button'=>'Register'])

{!!  Form::close() !!}     

	@include('students.files')

{!! Form::open(['route' => ['students.educations.create',$student->id],'method'=>'PUT','onsubmit'=>'myButton.disabled = true; return true;']) !!}       
	
	@include('students.educations',['button'=>'Register education'])

{!!  Form::close() !!}
</div>
@stop