 @if(strpos(strtolower($file),'pdf'))
 <div class='imgList'>
   <i class="fa fa-file-pdf-o imgList" style="font-size:60px;"></i>
   <br>
   {!! $file !!}
 </div>
 @else
	<img src='{!! Url() !!}/{!! $file !!}' class='imgList'>
 @endif