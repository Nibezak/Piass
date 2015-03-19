<div id='preview'>
@if($files = $student->files)
	@foreach($files as $file)

	    <!-- Check if it's a pdf -->
	    @if(strpos(strtolower($file->name),'pdf'))
	      <div class='imgList'>
	       
  			 {!! $file->name !!} <a href="{!! route('student.file.delete',$file->id)!!}" "email me">X</a>
  			 <br> 
	      <i class="fa fa-file-pdf-o" style="font-size:60px;"></i>
	       
	      </div>

	      <?php continue ?>
	    @endif
{!! $file->name !!} <a href="{!! route('student.file.delete',$file->id)!!}" "email me">X</a>
<br/>
		<img src='{!! Url() !!}/uploads/student{!! $student->id !!}/{!! $file->name !!}' class='imgList'>
	@endforeach
@endif
</div>
	
{!! Form::open(['route' => 'files.store','method'=>'POST','files'=>true,'id'=>'imageform']) !!}

 {!! Form::hidden('student_id', $student->id) !!}
<div id='imageloadstatus' style='display:none'>
<img src="{!! Url() !!}/assets/dist/img/loader.gif" alt="Uploading...."/></div>
<div id='imageloadbutton'>
<input type="file" name="file" id="photoimg" multiple="true" />
</div>

{!! Form::close() !!}