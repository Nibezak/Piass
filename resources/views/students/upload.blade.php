{!! Form::open(['route'=>'files.store','file'=>true,'class'=>'dropzone dz-clickable','id'=>'demo-upload']) !!}

  <div class="dz-message">
    <strong>Drop files here or click to upload</strong>.<br>
    <span class="note">(Selected files <strong>are automatically</strong>  uploaded.)</span>
    <br/>
    <span>Only pictures(PNG and JEPG) and File(PDF) are accept</span>
  </div>

{!! Form::close() !!}

