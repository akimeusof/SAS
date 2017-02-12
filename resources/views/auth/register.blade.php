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
<body class="hold-transition register-page">
<div class="register-box">
    <br><br><br><br>
    <div class="register-logo">
        <a href="{{URL::Route('login')}}"><b>SAS</b>Register</a>
    </div>
        <p class="login-box-msg">Register a new membership</p>
        @if(count($errors))
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    {!! Form::open(array(
                       'class' => 'form-horizontal',
                       'route' => 'handleRegister')) !!}
        <div class ="form-group has-feedback">
            <label class ="col-sm-3 control-label">*Username:</label>
            <div class="col-xs-9">
                {{--{!! Form::text('username', null, array('class' => 'form-control')) !!}--}}
                {!! Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'userexample')) !!}

            </div>
        </div>
        <div class="form-group has-feedback">
            <label class ="col-sm-3 control-label">*Password:</label>
            <div class="col-xs-9">
                {!! Form::password('password', array('class' => 'form-control', 'placeholder' => '********')) !!}
            </div>
        </div>
        <div class="form-group has-feedback">
            <label class ="col-sm-3 control-label">*ID:</label>
            <div class="col-xs-9">
                {!! Form::text('id', null, array('class' => 'form-control', 'placeholder' => 'SW094683')) !!}
            </div>
        </div>
        <div class="form-group has-feedback">
            <label class ="col-sm-3 control-label">*Programme:</label>
            <div class="col-xs-9">
                <select name="programme_id" class="form-control">
                    @foreach($programmes as $programme)
                        <option value="{{$programme->programme_id}}">{{$programme->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group has-feedback">
            <label class ="col-sm-3 control-label">*Name:</label>
            <div class="col-xs-9">
                {!! Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'FirstName LastName')) !!}
            </div>
        </div>
        <div class="form-group has-feedback">
            <label class ="col-sm-3 control-label">*E-mail:</label>
            <div class="col-xs-9">
                {!! Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'user@example.com')) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3">
                <div class="form-group has-feedback">
                    <input type="hidden" value="student" name="type">
                    <input type="hidden" value="1" name="status">

                </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <a class="btn btn-default btn-block btn-flat" href="{{ route('login') }}">Cancel</a>
            </div>
            <div class="col-xs-1">
            </div>
            <div class="col-xs-4">
                {!! Form::submit('Sign Up', array('class' => 'btn btn-primary btn-block btn-flat')) !!}
            </div>
            <!-- /.col -->
        </div>
    {!! Form::close() !!}
        <br>

    </div>
</div>
<!-- /.register-box -->

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
