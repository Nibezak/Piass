<div style="border: 1px solid #323232;padding: 2px;">
      {!! Form::open(array('route'=>'students.upload','method'=>'POST', 'files'=>true)) !!}
        <label style="float:left;text-decoration: underline;">upload online registrations </label>
        {!! Form::file('studentsfile',['style'=>'float:left;margin-left:10px;']) !!} 
        {!! Form::submit('upload', array('class'=>'btn btn-success','style'=>'padding-left:10px;')) !!}  
    {!! Form::close() !!}
</div>