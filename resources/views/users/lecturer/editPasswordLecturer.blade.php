@extends('layout.layoutSubLecturer')
@section('content')
 </section>

    <!-- Main content -->
<section class="content">
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

<!-- Default box -->
    <div class="box">
        <div class="box-header">
            <h4><b>{{ strtoupper($lecturer->username)}}</b>'s Profile</h4>
        </div>
        <div class="box-body">
            {!! Form::model($lecturer, array(
                               'method' => 'patch',
                               'route' => ['handleEditPasswordLecturer'],
                               'class' => 'form-horizontal'

                           )) !!}
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Username:</label>
                <div class="col-xs-4">
                    {!! Form::text('username', $lecturer->username, array('class' => 'form-control', 'disabled' => 'disabled')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">ID:</label>
                <div class="col-xs-4">
                    {!! Form::text('id', $lecturer->lecturerprofile->id, array('class' => 'form-control', 'disabled' => 'disabled')) !!}
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
                    <a class="btn btn-default btn-block btn-lg" href="{{ route('profileLecturer') }}">Cancel</a>
                </div>
                <div class="col-xs-2">
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