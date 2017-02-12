<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/dist/css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('assets/plugins/iCheck/square/blue.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <br><br><br><br><br><br><br>
    <div class="login-logo">
        <a href="{{URL::Route('register')}}"><b>SAS</b>Login</a>
    </div>
    <!-- /.login-logo -->
        <p class="login-box-msg">Please sign in to start your session</p>
        @if(count($errors))
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(\Session::has('successMessage'))
            <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('successMessage') !!}</em></div>
        @endif
        {!! Form::open(array('route' => 'handleLogin')) !!}
        <div class="form-group has-feedback">
            {!! Form::text('username', null, array('class' => 'form-control', 'placeholder' => '* Username')) !!}
        </div>
        <div class="form-group has-feedback">
            {!! Form::password('password', array('class' => 'form-control', 'placeholder' => '* Password')) !!}
        </div>
        <div class="row">
            <div class="col-xs-8">

            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                {!! Form::submit('Login', array('class' => 'btn btn-primary btn-block btn-flat')) !!}
            </div>
            <!-- /.col -->
            {!! Form::close() !!}
        </div>

        <br>
        <a href="{{url('/register')}}">Not a User? Click Here to Register</a><br>
        {{--        {!! link_to_route('users.create', 'Not a User? Click Here to Register')  !!}--}}


    </div>
    <!-- /.login-box-body --><!-- /.login-box -->

<!-- jQuery 2.2.0 -->
<script src="{{asset('assets/plugins/jQuery/jQuery-2.2.0.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('assets/plugins/iCheck/icheck.min.js')}}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
