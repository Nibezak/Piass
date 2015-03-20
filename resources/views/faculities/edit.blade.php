@extends('layouts.default')

@section('title')
Edit {{$faculity->name}}'s informations
@stop

@section('description')
Modify below information then click on <strong>Edit</strong> to edit this faculity information
@stop


@section('content')
<div class="box">
      
{!! Form::open(['route'=>['settings.faculities.update',$faculity->id],'method' => 'PUT']) !!}       

	@include('faculities.form',['button'=>'Edit'])

{!!  Form::close() !!}  	
   
</div><!-- /.box-body -->

@stop