@extends('layout.layoutSubAdmin')
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
            <h4><b>{{ strtoupper($user->username)}}</b>'s Profile</h4>
        </div>
        {!! Form::model($user, array(
                               'method' => 'patch',
                               'route' => ['admin.update', $user->id],
                               'class' => 'form-horizontal'

                           )) !!}
        {{--<br>--}}
        {{--<img src="/uploads/avatar/{{isset($user->adminprofile)?$user->adminprofile->avatar:"default.jpg"}}" class="center-block user-image" style="width:250px; height:250px;  border-radius:50%">--}}
        <div class="box-body">
            <div class ="form-group">
                <label class ="col-sm-5 control-label"></label>
                <div class="col-xs-2">
{{--                    <a href="{{url('/avatarAdmin')}}">--}}
                        <img src="/uploads/avatar/{{isset($user->adminprofile)?$user->adminprofile->avatar:"default.jpg"}}" class="center-block user-image" title="Change Profile Photo" style="width:250px; height:250px;  border-radius:50%">
                    {{--</a>--}}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Username:</label>
                <div class="col-xs-4">
                    {!! Form::text('username', isset($user)?$user->username:"", array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Email:</label>
                <div class="col-xs-4">
                    {!! Form::email('email', isset($user->adminprofile)?$user->adminprofile->email:"", array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">ID:</label>
                <div class="col-xs-4">
                    {!! Form::text('id', isset($user->adminprofile)?$user->adminprofile->id:"", array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Name:</label>
                <div class="col-xs-4">
                    {!! Form::text('name', isset($user->adminprofile)?$user->adminprofile->name:"", array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Phone #:</label>
                <div class="col-xs-4">
                    {!! Form::text('phonenumber', isset($user->adminprofile)?$user->adminprofile->phonenumber:"", array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Home #:</label>
                <div class="col-xs-4">
                    {!! Form::text('homenumber', isset($user->adminprofile)?$user->adminprofile->homenumber:"", array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Address:</label>
                <div class="col-xs-4">
                    {!! Form::textarea('address', isset($user->adminprofile)?$user->adminprofile->address:"", array('class' => 'form-control', 'rows' => '5')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"></label>
                <div class="col-xs-2">
                    <a class="btn btn-default btn-block btn-lg" href="{{ route('profileAdmin') }}">Cancel</a>
                </div>
                <div class="col-xs-2">
                    {!! Form::submit('Update', array('class' => 'btn btn-block btn-success btn-lg')) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
    </div>
        <!-- /.box -->

@stop()