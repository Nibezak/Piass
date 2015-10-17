@extends('layouts.default')

@section('title')
Marks
@stop

@section('description')
In this section you will be able to mark students
@stop
@section('content')
 <div class="box">
    @include('marks.module_filter')
    you are welcome to marks module
 </div>
@stop