@extends('layouts.default')

@section('title')
Edit {{$department->name}}'s informations
@stop

@section('description')
Modify below information then click on <strong>Edit</strong> to edit this department information
@stop


@section('content')
<div class="box">
      
{!! Form::open(['route'=>['settings.departments.update',$department->id],'method' => 'PUT']) !!}       

	@include('departments.form',['button'=>'Edit'])

{!!  Form::close() !!}  	
   
</div><!-- /.box-body -->

@stop