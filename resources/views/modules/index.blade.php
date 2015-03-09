@extends('layouts.default')

@section('title')
Modules under {!! $department->name !!} department
@stop

@section('description')
List of PIASS modules that are currently registered under  {!! $department->name !!} department
@stop


@section('content')
<div class="box">
                <div class="box-header">
                  <a href="{!! route('modules.department.create',[$department->id,$level]) !!}" class="btn btn-success">Register new module
                   <i class="fa fa-plus"></i>
                  </a>
                    <div class="box-tools row">
                   <div class="col-md-6">
                    {!! $modules->render() !!}
                  </div>
                 
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    
                    @include('modules.table')

                </div><!-- /.box-body -->
              </div>

@stop