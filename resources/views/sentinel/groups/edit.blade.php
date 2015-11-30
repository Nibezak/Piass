@extends(config('sentinel.layout'))

<!-- Web site Title -->
@section('title')
@parent
Edit Group
@stop

<!--- Content -->
@section('content')
<section class="content">
<div class="box">
<form method="POST" action="{!! route('sentinel.groups.update', $group->hash) !!}" accept-charset="UTF-8">
  
        <div class="small-6 large-centered columns">
            <h3>Edit Group</h3>         
        <div class="small-2 columns">
            <label for="right-label" class="right inline">Name</label>
        </div>
        <div class="small-10 columns {!! ($errors->has('name')) ? 'error' : '' !!}">
            <input placeholder="Name" name="name" value="{!! Input::old('name') ? Input::old('name') : $group->name !!}" type="text">
            {!! ($errors->has('name') ? $errors->first('name', '<small class="error">:message</small>') : '') !!}
        </div>
  
        {!! Form::label('edit_memberships', 'Permissions') !!}  
        <?php $defaultPermissions = config('sentinel.default_permissions', []); ?>
        <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <?php $permissionGroup = null;  ?>
        @foreach ($defaultPermissions as $permission)
            @if ($permissionGroup != explode('.', $permission)[0] )
                @if (!is_null($permissionGroup))
                    </ul>
                @endif
                <h4>{!! $permissionGroup = explode('.', $permission)[0] !!}</h4>
                <ul>
            @endif
            <li>
            <input name="permissions[{!! $permission !!}]" value="1" type="checkbox" {!! (isset($permissions[$permission]) ? 'checked' : '') !!}>
            <?php $permissionLabel =  explode('.', $permission); ?>
            @if (count($permissionLabel) > 0)
              @foreach ($permissionLabel as $key => $value)
              {{-- if the permission doesn't have sub keys then display the key and continue --}}
              @if ($key == 0  && count($permissionLabel) > 1)
                <?php continue; ?>
              @endif
               {!! $value !!}
              @endforeach 
            @endif
              
            </li>
        @endforeach 
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <h2> MARKING PERMISSIONS </h2>
            <?php $departments = App\Models\Department::all(); ?>
                @foreach ($departments as $department)
                     <h4>{!! $department->name !!}</h4>
                     <ul>
                         @foreach ($department->modules as $module)
                            <li>
                              <input name="permissions[{!! $department->name.'.'.$module->name !!}]" value="1" type="checkbox" {!! (isset($permissions[$department->name.'.'.$module->name]) ? 'checked' : '') !!}>
                              {!! ucwords(str_replace('.', ' ', $module->name)) !!}
                            </li>
                         @endforeach
                     </ul>         
                @endforeach 
            </div>
        </div>
    </div>
    <div class="row">
  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
   <input name="id" value="{!! $group->hash !!}" type="hidden">
    <input name="_method" value="PUT" type="hidden">
    <input name="_token" value="{!! csrf_token() !!}" type="hidden">
    <input  value="Save Changes" type="submit"  class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn btn-lg btn-success">
  </div>
  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <a href="{{ route('sentinel.groups.index') }}" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn btn-lg btn-danger">
       Cancel 
    </a>
  </div>
  </div>
{!! Form::close() !!}
</div>
</div>
@stop