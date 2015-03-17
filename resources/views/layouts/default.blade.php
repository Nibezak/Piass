<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>PIASS| STUDENT MANAGEMENT SYSTEM</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{Url()}}/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="{{Url()}}/assets/fontawesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{Url()}}/assets/ionicons/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{Url()}}/assets/dist/css/piassStudent.css" rel="stylesheet" type="text/css" />
  
    <!-- Drop zone -->
     <link href="{{Url()}}/assets/dropzone/dropzone.css" rel="stylesheet" type="text/css" />
     <script src="{{Url()}}/assets/dropzone/dropzone.js"></script>
    <!-- PIASS Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="{{Url()}}/assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue">
    <!-- Site wrapper -->
    <div class="wrapper">
      
      @include('partials.header')

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
          @include('partials.leftnav')
        <!-- /.sidebar -->
      </aside>
 
      <!-- =============================================== -->

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
          @include('partials.contentHeader')

          @include('partials.notification')
        <!-- Main content -->
        <section class="content">
          
          <!-- Default box -->
           @include('partials.container')
          <!-- /.box -->

        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

      @include('partials.footer')
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="{{Url()}}/assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{Url()}}/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="{{Url()}}/assets/plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='{{Url()}}/assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- DATEPICKER App -->
    <script src="{{Url()}}/assets/dist/js/app.min.js" type="text/javascript"></script>
    <script src="{{Url()}}/assets/dist/js/datepickr.js" type="text/javascript"></script>
    <script src="{{ Url() }}/assets/js/app.js" type="text/javascript"></script>

    <script type="text/javascript">
            new datepickr('date', {
                'dateFormat': 'Y-m-d'
            });
        </script>  
  </body>
</html>