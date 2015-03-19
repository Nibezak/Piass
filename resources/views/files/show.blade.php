 @if(strpos(strtolower($file),'pdf'))
 <div class='imgList'>
   <i class="fa fa-file-pdf-o imgList" style="font-size:60px;"></i>
   <br>
   {!! $file !!} <a href="{!! route('student.file.delete',$fileinfo->id)!!}" "email me">X</a>
 </div>
 @else
   {!! $file !!} <a href="{!! route('student.file.delete',$fileinfo->id)!!}" "email me">X</a>
	<img src='{!! Url() !!}/{!! $file !!}' class='imgList'>
 @endif