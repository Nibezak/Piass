$(document).ready(function()
{
    /** If a facutlity is chosen the load it's departments */
   $('select#faculities').change(function()
   {
        var faculityId = $(this).val();
    
        document.getElementById('department_section').style.display = 'block';

        $.get('/api/departments/'+faculityId, function(data)
        {
            
            $('select#departments').html('<option value="0">Select Department</option>');

            $.each(data, function(id, name)
            {
                $('select#departments').append('<option value="'+id+'">'+name+'</option>');
            });
        }, 'json');
    });

   /** If a department is chosen then load it's levels */
   $('select#departments').change(function()
    {
        var departmentId = $(this).val();

        document.getElementById('department_level').style.display="block";

        $.get('/api/department/level/'+departmentId,function(data)
            {
                $('select#departmentlevel').html('<option value="0">Choose level</option>');

                for (var level = 1 ; level <= data; level++)
                {
                    $('select#departmentlevel').append('<option value="'+level+'">'+level+'</option>');
                };

            },'json');
    });

    /** If a department is chosen then load it's levels */
   $('select#departmentlevel').change(function()
    {
        var departmentId = $('select#departments').val();
        var level        = $(this).val();
        
        $.get('/api/department/'+departmentId+'/level/'+level,function(data)
            {
           $.each(data, function(modules,module)
            {
                 $('tbody.levelmodules').append('<tr><td><input type="hidden" name="ids[]" value="'+module.id+'"/>'+module.name+'</td><td>'+module.code+'</td><td><input type="text" name="credits[]" size="4" value="'+module.credits+'"/></td><td>'+module.credit_cost+'</td></tr>');
            });
               

            },'json');
        document.getElementById('moduletable').style.display="block";
        document.getElementById('button').style.display="block";
    });
});