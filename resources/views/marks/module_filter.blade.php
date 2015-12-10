<div class="row header-container">
<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
 <label>Choose Faculity</label>
 <?php $faculities[0] ='Select faculity'; ?>
  {!! Form::select('faculity', $faculities, 0,['class'=>'form-control select-faculity']) !!}
</div>
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
<label>Choose Department</label>
      <select name="department" class="form-control select-department">
			<option>Choose faculity first.</option>
      </select>
</div>
<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
<label>Level</label>
	<select name="level" class="form-control select-level">
			<option>Choose department first.</option>
    </select>
</div>
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
<label>Choose module</label> 
	<select name="level" class="form-control select-module">
			<option>Choose level first.</option>
    </select>
</div>
<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
<label>Choose Academic year</label> 
	<select name="academic_year" class="form-control select-academic-year">
			<option>Choose module first.</option>
    </select>
</div>
</div>