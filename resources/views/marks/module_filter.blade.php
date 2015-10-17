<div class="row header-container">
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">

 <label>Select Faculity</label>
  {!! Form::select('faculity', $faculities, null,['class'=>'form-control select-faculity']) !!}
</div>
<div class="col-xs-1 col-sm-3 col-md-1 col-lg-3">
<label>Select Department</label>
 <div class="department-list"> 
      <div class="form-control">Please select a faculity first</div>
</div>
</div>

<div class="col-xs-1 col-sm-3 col-md-1 col-lg-3">
<label>Select module</label>
	<div class="module-list">
		 <div class="form-control">Please select a department first</div>
	</div>
</div>

<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
<label>Select level</label> 
	<div class="level-list">
		 <div class="form-control">Please select a department first</div>
	</div>
</div>
</div>

