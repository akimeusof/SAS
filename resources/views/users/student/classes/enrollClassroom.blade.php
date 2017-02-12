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
    <div class="box">
        <div class="box-body">
            <center>
                <h1><b>Enroll</b> to <b>{{$classroom->subject->name}}</b></h1>
            </center>
            {!! Form::open(array('class' => 'form-horizontal',
                                'route' => 'studentClassroomOperation.store'))
            !!}
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Lecturer:</label>
                <div class="col-xs-4">
                    <label class ="control-label">{{isset($classroom->lecturerprofile)?$classroom->lecturerprofile->name:"No lecturer for this class"}}</label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Subject:</label>
                <div class="col-xs-4">
                    <label class ="control-label">{{isset($classroom->subject)?$classroom->subject->code." - ".$classroom->subject->name:"No subject selected"}}</label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Section:</label>
                <div class="col-xs-4">
                    <label class ="control-label">{{isset($classroom)?$classroom->section:""}}</label>
{{--                        {!! Form::password('currentpassword', array('class' => 'form-control')) !!}--}}
                </div>

            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Enrollment Key:</label>
                <div class="col-xs-4">
                    {!! Form::password('enrollmentkey', array('class' => 'form-control')) !!}
                </div>
            </div>

            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Re-Enter Enrollment Key:</label>
                <div class="col-xs-4">
                    {!! Form::password('confirmenrollmentkey', array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"></label>
                <div class="col-xs-2">
{{--                    <a href="{{ route('studentAssessmentOperation.edit', $classroom->classroom_id) }}" class="btn btn-success btn-block btn-flat" onclick="return ConfirmAttempt()">Attempt Assessment</a>--}}

                    <a href="{{URL::previous()}}" class="btn btn-block btn-default btn-lg">Back</a>
                </div>
                <div class="col-xs-2">
                    {!! Form::hidden('classroomenrollmentkey', $classroom->enrollmentkey) !!}
                    {!! Form::hidden('user_id', \Auth::user()->id) !!}
                    {!! Form::hidden('classroom_id', $classroom->classroom_id) !!}
                    {!! Form::hidden('status', 1) !!}
                    {{--{!! Form::hidden('classroom', $classroom->classroom_id) !!}--}}
                    {!! Form::submit('Enroll', array('class' => 'btn btn-block btn-primary btn-lg')) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
        {{--<div class="box-footer">--}}
        {{--</div>--}}
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->


@stop()