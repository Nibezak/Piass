@extends('layouts.default')

@section('title')
Current departments
@stop

@section('description')
List of PIASS departments that are currently registered
@stop


@section('content')
<div class="box">
                <div class="box-header">
                  <a href="{{route('settings.departments.create')}}" class="btn btn-success">Register new department
                   <i class="fa fa-plus"></i>
                  </a>
                    <div class="box-tools row">
                   <div class="col-md-6">
                    {!! $departments->render() !!}
                  </div>
                 
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    
                    @include('departments.table')

                </div><!-- /.box-body -->
              </div>

@stop