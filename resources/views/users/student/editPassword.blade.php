@extends('layout.layoutSubStudent')
@section('content')


@if(count($errors))
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<h1><b>{{ $user->username}}</b>'s Profile</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-body">
            {!! Form::model($user, array(
                              'method' => 'patch',
                              'route' => ['s_handleEditPassword'],
                              'class' => 'form-horizontal'

                          )) !!}
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Username:</label>
                <div class="col-xs-4">
                    {!! Form::text('username', $user->username, array('class' => 'form-control', 'disabled' => 'disabled')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">ID:</label>
                <div class="col-xs-4">
                    {!! Form::text('id', $user->studentprofile->id, array('class' => 'form-control', 'disabled' => 'disabled')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Current Password:</label>
                <div class="col-xs-4">
                    {!! Form::password('currentpassword', array('class' => 'form-control')) !!}
                </div>

            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">New Password:</label>
                <div class="col-xs-4">
                    {!! Form::password('newpassword', array('class' => 'form-control')) !!}
                </div>
            </div>

            <div class ="form-group">
                <label class ="col-sm-4 control-label">Re-Type New Password:</label>
                <div class="col-xs-4">
                    {!! Form::password('confirmpassword', array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"></label>
                <div class="col-xs-4">
                    <input type="hidden" name="id" value="{{$user->id}}">
                    {!! Form::submit('Change Password', array('class' => 'btn btn-block btn-success btn-lg')) !!}
                    {{--<a href="URL::route('admin.show', $admin->id)" class="btn btn-block btn-primary btn-lg">Update Profile</a>--}}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        </div>
        <!-- /.box-footer-->
    </div>
        <!-- /.box -->


@stop()