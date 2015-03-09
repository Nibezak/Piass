@extends('layouts.default')

@section('title')
Current students
@stop

@section('description')
List of PIASS students that are currently registered
@stop


@section('content')
<div class="box">
                <div class="box-header">
                    <div class="box-tools row">
                   <div class="col-md-6">
                    {!! $students->render() !!}
                  </div>
                  <div class="col-md-6">
                    {!! Form::open(['route' => 'fees.index', 'method' => 'get']) !!}
                     @include('partials.search') 
                  {!! Form::close() !!}
                  </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    
                    @include('fees.table')

                </div><!-- /.box-body -->
              </div>

@stop