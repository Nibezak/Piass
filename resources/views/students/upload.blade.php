{!! Form::open(['route'=>'files.store','file'=>true,'class'=>'dropzone dz-clickable','id'=>'upload']) !!}
	
	{!! Form::hidden('student_id', $student->id) !!}
    <strong>Only pictures(PNG and JEPG) and File(PDF) are accept</strong>

{!! Form::close() !!}



<script type="text/javascript">
var myDropzone = new Dropzone("#upload", 
{
  addRemoveLinks:{
  	dictCancelUploadConfirmation:true,
  	dictCancelUpload:true,
   	dictRemoveFile:true
  }
});
</script>

