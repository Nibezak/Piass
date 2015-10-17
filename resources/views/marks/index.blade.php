@extends('layouts.default')

@section('title')
Marks
@stop

@section('description')
In this section you will be able to mark students
@stop
@section('content')
 <div class="box">
    @include('marks.module_filter')
    you are welcome to marks module
 </div>
@stop

@section('footer')
<script type="text/javascript">
  /** SECTION OF THE MARKS MODULE THAT HELPS TO SELECT DEPARTMENTS */
 $(document).ready(function(){
    // if someone changes the faculities drop box,
    // then load faculities modules
    var departments = 
    $('.select-faculity').on('change',function(event){
      var faculity = $(this).val();

      $.ajax({
        url: '/api/departments/'+faculity,
        type: 'GET',
        dataType: 'json'
      })
      .done(function(data) {

        var departmentOptions = '';
        $.each(data, function(index, val) {
           /* iterate through department */
           departmentOptions += '<option value="'+index+'">'+val+'</option>';
        });

        // If we didn't get any department then show below
        if(departmentOptions == '')
        {
      departmentOptions='<option>We could not find any department for this faculity</option>';
      alert('We could not find any department related to faculity. Go to left menu and verify if this faculity has as department and try again');
        };

         $('.select-department').html(departmentOptions);
      })
      .fail(function(error) {
        alert(error.responseText);
      });
    });

    /** if someone chooses a department then load it's modules */
    $('.select-department').on('change',function(event){
      var department = $(this).val();
      $.ajax({
        url: '/api/department/level/'+department,
         type: 'GET',
        dataType: 'json'
      })
      .done(function(level) {
        var levelOptions = '<option>Please select a level </option>';
        for (var i = 1; i <= level; i++) {        
           levelOptions += '<option value="'+i+'">'+i+'</option>';
        };
        // If level options has nothing then display the error
        if(levelOptions == '<option>Please select a level </option>')
        {
          levelOptions ='<option>We could not find any level for selected department</option>';
          alert('We could not find any level for the selected department. Go to settings module and verify if this department has level then try again');
        };
        $('.select-level').html(levelOptions);
      })
      .fail(function(error) {
        alert(error.responseText);
      });
    });

    /** IF SOMEONE CHOOSE LEVELS THEN LOAD MODULES */
    $('.select-level').on('change',function(event){
      var level = $(this).val();
      var department = $('.select-department').val();

      $.ajax({
        url: '/api/department/'+department+'/level/'+level+'/modules',
        type: 'GET',
        dataType: 'json'
      })
      .done(function(modules) {
        var moduleOptions = '';

        $.each(modules, function(index, val) {
           /* iterate through department */
           moduleOptions += '<option value="'+index+'">'+val+'</option>';
        });
        // If we didn't find module, just display message
        // that we could not find any module for the selected level.
        // and guide use what to be done
        if(moduleOptions == '')
        {
          moduleOptions =  '<option>We could not find the module for this level.</option>';
          alert('We could not find module for this level, Please verify if this department level has modules then contintue');
        };
        $('.select-module').html(moduleOptions);
      })
      .fail(function(error) {
        alert(error.responseText);
      });
    });

    // 
    // select-academic-year
    /** IF SOMEONE CHOOSE A MODULE THEN ACADEMIC YEARS */
    $('.select-module').on('change',function(event){
      var level = $('.select-level').val();
      var module = $('.select-module').val();

      $.ajax({
        url: 'api/level/'+level+'/modules/'+module+'/academicyears',
        type: 'GET',
        dataType: 'json'
      })
      .done(function(academicyears) {
        var academicyearsOptions = '';

        $.each(academicyears, function(index, val) {
           /* iterate through department */
           academicyearsOptions += '<option value="'+index+'">'+val+'</option>';
        });
        // If we didn't find module, just display message
        // that we could not find any module for the selected level.
        // and guide use what to be done
        if(academicyearsOptions == '')
        {
          academicyearsOptions =  '<option>We could not find academicyears for this module.</option>';
          alert('We could not find academic years for this module Please verify if there is any student registered under this module');
        };

        $('.select-academic-year').html(academicyearsOptions);
      })
      .fail(function(error) {
        alert(error.responseText);
      });
    });
  });

</script>
@stop