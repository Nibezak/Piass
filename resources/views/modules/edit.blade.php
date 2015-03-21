@extends('layouts.default')

@section('title')
Edit {{$module->name}}'s informations
@stop

@section('description')
Modify below information then click on <strong>Edit</strong> to edit this module information
@stop


@section('content')
<div class="box">
      
{!! Form::open(['route'=>['modules.update',$module->id],'method' => 'PUT','onsubmit'=>'myButton.disabled = true; return true;']) !!}       

	@include('modules.form',['button'=>'Edit'])

{!!  Form::close() !!}  	
   
</div><!-- /.box-body -->

@stop