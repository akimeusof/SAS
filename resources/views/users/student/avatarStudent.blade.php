@extends('layout.layoutSubStudent')
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
            <h2><b>{{ strtoupper($student->username)}}</b>'s Profile</h2>
        </div>
        <div class="box-body">
            {!! Form::open(array('route' => 'handleAvatarStudent', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')) !!}
            <div class ="form-group">
                <label class ="col-sm-5 control-label"></label>
                <div class="col-xs-2">
                    <a href="{{url('/avatarStudent')}}">
                        <img src="/uploads/avatar/{{isset($student->studentprofile)?$student->studentprofile->avatar:"default.jpg"}}" class="center-block user-image" title="Change Profile Photo" style="width:250px; height:250px;  border-radius:50%">
                    </a>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Select New Picture: (5Mb Max)</label>
                <div class="col-xs-4">
                    {!! Form::file('avatar', array('class' => 'form-control', 'center-block')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"></label>
                <div class="col-xs-2">
                    <a href="{{URL::route('profileStudent')}}" class="btn btn-block btn-default btn-lg">Cancel</a>
                </div>
                <div class="col-xs-2">
                    {!! Form::submit('Upload', array('class' => 'btn btn-block btn-primary btn-lg')) !!}
                    {{--                        <a href="{{URL::route('avatarLecturer', $lecturer->id)}}" class="btn btn-block btn-primary btn-lg">Upload</a>--}}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

@stop()