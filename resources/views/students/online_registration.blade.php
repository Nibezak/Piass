<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>PIASS Online registration </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
       <!-- Bootstrap 3.3.2 -->
    <link href="{{Url()}}/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="{{Url()}}/assets/fontawesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{Url()}}/assets/ionicons/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{Url()}}/assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
    .has-error {
    color: #dd4b39;
    font-size: 12px;
    font-weight: 200;
}</style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
      @if (Session::has('flash_notification.message'))
    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('flash_notification.message') }}
    </div>
@endif
      {!! Form::open(['route' => 'student.online.registration','method'=>'post']) !!}       
        
        {!! Form::hidden('online_registered', '1') !!}
        @include('students.form',['button'=>'Register'])

      {!!  Form::close() !!}    

    <!-- jQuery 2.1.3 -->
    <script src="{{Url()}}/assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{Url()}}/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="{{Url()}}/assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
  </body>
</html>
