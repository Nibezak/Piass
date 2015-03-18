<div id='preview'>
</div>
	
<form id="imageform" method="post" enctype="multipart/form-data" action='ajaxImageUpload.php' style="clear:both">
<h1>Upload your images</h1> 
<div id='imageloadstatus' style='display:none'>
<img src="{!! Url() !!}/assets/dist/img/loader.gif" alt="Uploading...."/></div>
<div id='imageloadbutton'>
<input type="file" name="photos[]" id="photoimg" multiple="true" />
</div>
</form>