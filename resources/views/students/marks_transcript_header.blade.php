<div class="row header-container">
	 <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		 <table class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<tr>
				<th>NAMES : </th>
				<td>{!! $student->names !!}</td>
			</tr>
			<tr>
				<th>REG. NUMBER:</th>
				<td>{!! $student->registration_number !!}</td>
			</tr>
		 </table>	 
	   </div>
	    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		 <table class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<tr>
				<th>FACULTY : </th>
				<td>{!! $student->department->faculity->name !!}</td>
			</tr>
			<tr>
				<th>DEPARTMENT:</th>
				<td>{!! $student->department->name !!}</td>
			</tr>
		  </table>	 
	   </div>
	</div>