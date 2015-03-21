@extends('layouts.default')

@section('title')
{!! $student->names !!}'s fees
@stop

@section('description')
Please find below {!! $student->names !!}'s fees transactions as of now.
@stop


@section('content')
<div class="box">

	@include('students.feestable')

</div>
@stop