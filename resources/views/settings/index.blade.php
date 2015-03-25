@extends('layouts.default')

@section('title')
<i class="fa fa-cogs"></i> SETTINGS
@stop
@section('description')
 Please use below form to modify settings
@stop

@section('content')
<div class="box-body">
  <div class="row">
    <div class="col-md-9">
      <p class="text-center"> 
       {!! Form::open(['route' => 'settings.store', 'method' => 'post']) !!}
          <table class="table table-user-information">
                <tbody>
                  <tr>
                    <th>Name </th>
                    <th>Value</th>
                  </tr>
         @foreach ($settings as $key => $value)
         
                  <tr>
                    <th>{!! $key !!} </th>
                    <th> 
                  {!! Form::text($key, $value, ['class'=>'form-control']) !!}
                    </th>
                  </tr>
          
        @endforeach
        </tbody>
        </table>
       {!! Form::submit('Save',['class' => 'btn btn-success']) !!}
        {!! Form::close() !!}
      </p>
   
     </div>
 </div>
 </div>
 
@stop
