@extends('layouts.default')
@section('title')
{!! $student->names !!}'s marks
@stop
@section('description')
Please find below {!! $student->names !!}'s marks as of now. 
<a href="{{ route('student.marks',[$student->id]) }}?export=printer" class="btn btn-success pull-right" style="margin-right: 5px;" target="_blank">
<i class="fa fa-print"></i> Print</a>
<a href="{{ route('student.marks',[$student->id]) }}?export=excel" class="btn btn-success pull-right" style="margin-right: 5px;">
<i class="fa fa-file-excel-o"></i> Excel</a>

@stop
@section('content')

  {!! $report !!}
@stop