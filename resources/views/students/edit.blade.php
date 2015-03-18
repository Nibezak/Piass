@extends('layouts.default')

@section('title')
Edit {{$student->names}}'s informations
@stop

@section('description')
Modify below information then click on save to edit this student information
@stop


@section('content')
<div class="box">
      
{!! Form::open(['route' => ['students.update',$student->id,'method'=>'PUT']]) !!}       

	@include('students.form',['button'=>'Save'])

{!!  Form::close() !!}  
	
	@include('files.upload')

{!! Form::open(['route' => ['students.educations.update',$student->id],'method'=>'PUT']) !!}       
	
	@include('students.educations',['button'=>'Register education'])

{!!  Form::close() !!}  
   
</div><!-- /.box-body -->

@stop