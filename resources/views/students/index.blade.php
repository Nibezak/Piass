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
                  <div class="row">
                     <div class="col-md-3">
                      <a href="{{route('students.create')}}" class="btn btn-success">Register student <i class="fa fa-plus"></i></a>
                     </div>
                    <div class="col-md-8">
                       @include('partials.batch_upload')
                    </div>
                  </div>
                  <br/>
                  <div class="row">
                   <div class="col-md-6">
                    {!! $students->render() !!}
                  </div>
                  <div class="col-md-6">
                    {!! Form::open(['route' => 'students.index', 'method' => 'get']) !!}
                     @include('partials.search') 
                    {!! Form::close() !!}

                  </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    
                    @include('students.table')

                </div><!-- /.box-body -->
              </div>

@stop