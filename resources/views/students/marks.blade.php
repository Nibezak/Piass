@extends('layouts.default')

@section('title')
{!! $student->names !!}'s marks
@stop

@section('description')
Please find below {!! $student->names !!}'s marks as of now.
@stop
@section('content')
<div class="box">
<div class="box-header with-border">
  <h3 class="box-title"> {!! $student->names !!}'s fees transactions</h3>
  <div class="box-tools pull-right">
    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
  </div>
</div><!-- /.box-header -->
	@include('students.marks_report')
</div>
</div>
@stop