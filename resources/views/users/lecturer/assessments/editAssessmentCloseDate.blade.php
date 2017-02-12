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
            <center>
                <h3>Edit Assessment's <b>Close Date</b></h3>
            </center>
        </div>
        <div class="box-body">
            {!!
              Form::open(array('class' => 'form-horizontal',
                'route' => ['l_updateAssessmentCloseDate', $assessment->assessment_id]))
            !!}
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Class:</label>
                <div class="col-xs-4">
                    <label class="control-label">
                        {{isset($assessment->classroom->subject)?$assessment->classroom->subject->code." - ".$assessment->classroom->subject->name." - ".strtoupper($assessment->classroom->section):"null"}}
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Assessment Name:</label>
                <div class="col-xs-4">
                    <label class="control-label">
                        {{$assessment->assessmentname}}
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"><h4><b>Current Close Date:</b></h4></label>
                <div class="col-xs-4">
                    <label class ="control-label">
                        <h4><b>{{$assessment->end}}</b></h4>
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">New Open Date:</label>
                <div class="col-xs-4">
                    {!! Form::date('close_date', null, array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">New Open Time:</label>
                <div class="col-xs-4">
                    {!! Form::time('close_time', null, array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"></label>
                <div class="col-xs-2">
                    <a class="btn btn-default btn-block btn-flat" href="{{ route('lecturerAssessmentOperation.show', $assessment->assessment_id) }}">Back</a>
                </div>
                <div class="col-xs-2">
                    <input type="hidden" name="type" value="2">
                    {!! Form::submit('Update Assessment', array('class' => 'btn btn-success btn-block btn-flat'))!!}
                    {{--                    <a href="{{ route('l_AssessmentQuestionOperation.show', $assessment->assessment_id) }}" class="btn btn-success btn-block btn-flat">Update Assessment</a>--}}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop()
