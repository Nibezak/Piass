@extends('layouts.default')

@section('title')
Edit {{$student->names}}'s informations
@stop

@section('description')
Modify below information then click on save to edit this student information
@stop


@section('content')
<div class="box">
      
{!! Form::open(['url' => '/students/'.$student->id]) !!}       

	@include('students.form',['button'=>'Save'])

	@include('students.educations',['button'=>'Edit'])

{!!  Form::close() !!}  	
	@include('students.files')
   
</div><!-- /.box-body -->

@stop