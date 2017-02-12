@extends('layout.layoutSubStudent')
@section('content')
{{--    <h1><b>Update</b>:<b> {{ strtoupper($user->username)}}</b>'s Profile</h1>--}}
</section>

    <!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header">
            <h2><b>{{ strtoupper($user->username)}}</b>'s Profile</h2>
        </div>
        {!! Form::model($user, array(
                               'method' => 'patch',
                               'route' => ['student.update', $user->id],
                               'class' => 'form-horizontal'
                           )) !!}
        <div class="box-body">
            <div class ="form-group">
                <label class ="col-sm-5 control-label"></label>
                <div class="col-xs-2">
                    <input type="hidden" value="{{$user->id}}">
                    <img src="/uploads/avatar/{{$user->studentprofile->avatar}}" class="center-block user-image" title="Change Profile Photo" style="width:250px; height:250px;  border-radius:50%">
                </div>
            </div>
            {{--<div class ="form-group">--}}
                {{--<label class ="col-sm-4 control-label">Username:</label>--}}
                {{--<div class="col-xs-4">--}}
                    {{--{!! Form::text('username', $user->username, array('class' => 'form-control', 'readonly')) !!}--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class ="form-group">
                <label class ="col-sm-4 control-label">ID:</label>
                <div class="col-xs-4">
                    {!! Form::text('id', $user->studentprofile->id, array('class' => 'form-control', 'readonly')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Programme:</label>
                <div class="col-xs-4">
                    <select name="programme_id" class="form-control">
                        <option value="{{isset($user->studentprofile->programme)?$user->studentprofile->programme_id:""}}" selected>{{isset($user->studentprofile->programme)?$user->studentprofile->programme->name:""}}</option>
                        @foreach($programmes as $programme)
                            @if($programme->programme_id != $user->studentprofile->programme_id)
                                <option value="{{$programme->programme_id}}">{{$programme->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Email:</label>
                <div class="col-xs-4">
                    {!! Form::email('email', $user->studentprofile->email, array('class' => 'form-control', 'disabled' => 'disabled' )) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Name:</label>
                <div class="col-xs-4">
                    {!! Form::text('name', $user->studentprofile->name, array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Phone #:</label>
                <div class="col-xs-4">
                    {!! Form::text('phonenumber', $user->studentprofile->phonenumber, array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Home #:</label>
                <div class="col-xs-4">
                    {!! Form::text('homenumber', $user->studentprofile->homenumber, array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Address:</label>
                <div class="col-xs-4">
                    {!! Form::textarea('address', $user->studentprofile->address, array('class' => 'form-control', 'rows' => '5')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Operations:</label>
                <div class="col-xs-2">
                    <a href="{{route('profileStudent')}}" class="btn btn-block btn-flat btn-default btn-lg">Cancel</a>
                </div>
                <div class="col-xs-2">
                    {!! Form::submit('Update', array('class' => 'btn btn-block btn-success btn-lg')) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>

    </div>
        <!-- /.box -->

@stop()