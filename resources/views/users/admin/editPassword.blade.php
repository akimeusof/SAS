@extends('layout.layoutSubAdmin')
@section('content')
</section>

<!-- Main content -->
<section class="content">
{{--handle errors and success message--}}
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

        <div class="alert alert-success alert-dismissable">
            <span class="glyphicon glyphicon-ok"></span>
            <button type="button" class="close" data-dismiss="alert" aris-hidden="true">&times;</button>
            <em> {!! session('successMessage') !!}</em>

        </div>
    @endif

        <div class="box">
            <div class="box-header">
                <h4><b>{{ strtoupper($user->username)}}</b>'s Profile</h4>
            </div>
            <div class="box-body">
                {!! Form::model($user, array(
                                   'method' => 'patch',
                                   'route' => ['handleEditPassword'],
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
                        {!! Form::text('id', $user->adminprofile->id, array('class' => 'form-control', 'disabled' => 'disabled')) !!}
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
                    <div class="col-xs-2">
                        <a class="btn btn-default btn-block btn-lg" href="{{ route('profileAdmin') }}">Cancel</a>
                        {{--<a href="URL::route('admin.show', $admin->id)" class="btn btn-block btn-primary btn-lg">Update Profile</a>--}}
                    </div>
                    <div class="col-xs-2">
                        {!! Form::submit('Change Password', array('class' => 'btn btn-block btn-success btn-lg')) !!}
                        {{--<a href="URL::route('admin.show', $admin->id)" class="btn btn-block btn-primary btn-lg">Update Profile</a>--}}
                    </div>
                </div>
                {{--<div class ="form-group">--}}
                {{--<label class ="col-sm-4 control-label"></label>--}}
                {{--<div class="col-xs-3">--}}
                {{--<a href="--}}{{--URL::route('admin.show', $admin->id)--}}{{--" class="btn btn-block btn-primary btn-lg">Change Profile Photo</a>--}}

                {{--{!! Form::email('name', $user->adminprofile->email, array('class' => 'form-control', 'readonly')) !!}--}}
                {{--</div>--}}
                {{--</div>--}}

                {{--hue hue hue--}}
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <input type="hidden" value="{{$user->id}}">
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    {!! Form::close() !!}

@stop()