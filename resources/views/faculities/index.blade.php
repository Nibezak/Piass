@extends('layouts.default')

@section('title')
Current faculities
@stop

@section('description')
List of PIASS faculities that are currently registered
@stop


@section('content')
<div class="box">
                <div class="box-header">
                  <a href="{{route('settings.faculities.create')}}" class="btn btn-success">Register new Faculity <i class="fa fa-plus"></i></a>
                    <div class="box-tools row">
                   <div class="col-md-6">
                    {!! $faculities->render() !!}
                  </div>
                 
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    
                    @include('faculities.table')

                </div><!-- /.box-body -->
              </div>

@stop