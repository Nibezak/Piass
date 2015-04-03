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
                $('select#departmentlevel').html('<option value="0">level</option>');

                for (var level = 1 ; level <= data; level++)
                {
                    $('select#departmentlevel').append('<option value="'+level+'">'+level+'</option>');
                };

            },'json');
    });

   /** if a level is changed then show departments **/
   $('select#departmentlevel').change(function()
    {
        var departmentId = $('select#departments').val();
        var level        = $(this).val();
        
        $.get('/api/department/'+departmentId+'/level/'+level,function(data)
            {
                $('select#modulelist').html('<option value="0">Module</option>');

                console.log(data);

            $.each(data, function(modules,module)
            {
                 $('select#modulelist').append('<option  value="'+module.id+'"/>'+module.name+'</option>');
            });

            },'json');
    });



});
