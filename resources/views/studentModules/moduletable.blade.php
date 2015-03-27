<table class="table table-striped" id="moduletable" style="display:none">
	<thead>
	<tr>
		<th>Name </th>
		<th>Code </th>
		<th>Credits </th>
		@if($student->mode_of_study!='Full time')
		<th>Cost</th>
		@endif
	</tr>
   </thead>

   <tbody class="levelmodules">
   	
   </tbody>
 </table>

@section('footer')
<script>
	$(document).ready(function()
	{

	        var departmentId = $('select#departments').val();

	        document.getElementById('department_level').style.display="block";

	        $.get('/api/department/level/'+departmentId,function(data)
	            {
	                $('select#departmentlevel').html('<option value="0">Choose level</option>');

	                for (var level = 1 ; level <= data; level++)
	                {
	                    $('select#departmentlevel').append('<option value="'+level+'">'+level+'</option>');
	                };

	            },'json');

	    /** If a department is chosen then load it's levels */
	   $('select#departmentlevel').change(function()
	    {
	        var departmentId = $('select#departments').val();
	        var level        = $(this).val();
	        
	        $.get('/api/department/'+departmentId+'/level/'+level,function(data)
	            {

	            @if($student->mode_of_study=='Full time')
	           $.each(data, function(modules,module)
	            {
	                 $('tbody.levelmodules').append('<tr><td><input type="hidden" name="ids[]" value="'+module.id+'"/>'+module.name+'</td><td>'+module.code+'</td><td><input type="text" name="credits[]" size="4" value="'+module.credits+'"/></td></tr>');
	            });
	           @else
	            $.each(data, function(modules,module)
	            {
	                 $('tbody.levelmodules').append('<tr><td><input type="hidden" name="ids[]" value="'+module.id+'"/>'+module.name+'</td><td>'+module.code+'</td><td><input type="text" name="credits[]" size="4" value="'+module.credits+'"/></td><td>'+module.credit_cost+'</td><td><td><button class="fa fa-times-circle btn btn-danger" onclick="deleteRow(this)"  /></td></td></tr>');
	            });
	           @endif
	            },'json');
	        if( document.getElementById('moduletable') )
	        {
	        document.getElementById('moduletable').style.display="block";
	        document.getElementById('button').style.display="block";
	        }
	    });
	});
</script>
@stop