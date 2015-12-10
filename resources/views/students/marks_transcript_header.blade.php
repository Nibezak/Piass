<table  style="display: inline-table;width: 40%">
<tr>
	<th>NAMES : </th>
	<td>{!! $student->names !!}</td>
</tr>
<tr>
	<th>REG. NUMBER:</th>
	<td>{!! $student->registration_number !!}</td>
</tr>
</table>	 
<table class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="display: inline-table;width: 50%">
<tr>
	<th>FACULTY : </th>
	<td>{!! $student->department->faculity->name !!}</td>
</tr>
<tr>
	<th>DEPARTMENT:</th>
	<td>{!! $student->department->name !!}</td>
</tr>
</table>	