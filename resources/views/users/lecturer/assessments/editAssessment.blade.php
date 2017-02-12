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
                <h3>Edit Assessment: <b><u>{{$assessment->assessmentname}}</u></b></h3>
            </center>
        </div>
        <div class="box-body">
            {!! Form::model($assessment, array(
                               'method' => 'patch',
                               'route' => ['lecturerAssessmentOperation.update', $assessment->assessment_id],
                               'class' => 'form-horizontal'
                           )) !!}
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Class:</label>
                <div class="col-xs-4">
                    {!! Form::text('classroom', isset($assessment->classroom->subject)?$assessment->classroom->subject->code." - ".$assessment->classroom->subject->name." - ".strtoupper($assessment->classroom->section):"null", array('class' => 'form-control', 'readonly')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Assessment Name:</label>
                <div class="col-xs-4">
                    {!! Form::text('assessment_name', $assessment->assessmentname, array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Assessment Marks (%):</label>
                <div class="col-xs-4">
                    <select class="form-control" name="assessment_marks">
                        <option value="{{$assessment->assessmentmarks}}" selected>{{$assessment->assessmentmarks}}</option>
                        @for ($i = 1; $i <= 100; $i++)
                            @if($i != $assessment->assessmentmarks)
                                @if($i <=20)
                                    <option value="{{$i}}">{{$i}}</option>
                                @else
                                    <?php $i=$i+4;?>
                                    <option value="{{$i}}">{{$i}}</option>
                                @endif
                            @endif
                        @endfor
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class ="col-sm-4 control-label">Number of Question(s):</label>
                <div class="col-xs-4">
                    <select class="form-control" name="number_of_question">
                        <option value="{{$assessment->numberofquestion}}" selected>{{$assessment->numberofquestion}}</option>
                        @for ($i = 1; $i <= 20; $i++)
                            @if($i != $assessment->numberofquestion)
                                <option value="{{$i}}">{{$i}}</option>
                            @endif
                        @endfor
                    </select>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Duration (Minutes):</label>
                <div class="col-xs-4">
                    <select class="form-control" name="time_limit">
                        <option value="{{$assessment->duration}}" selected>{{$assessment->duration}}</option>
                        @for ($i = 10; $i <= 120; $i+=10)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                    {{--                        {!! Form::text('duration', null, array('class' => 'form-control', 'placeholder' => 'Duration of Assessment. EX: 60')) !!}--}}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Remarks:</label>
                <div class="col-xs-4">
                    {!! Form::textarea('remarks', isset($assessment->remarks)?($assessment->remarks):"", array('class' => 'form-control', 'rows' => '3')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"></label>
                <div class="col-xs-2">
                    <a class="btn btn-default btn-block btn-flat" href="{{ URL::previous() }}">Cancel</a>
                </div>
                {{--<div class="col-xs-2">--}}
                    {{--<a href="{{ route('lecturerAssessmentOperation.edit', $assessment->assessment_id) }}" class="btn btn-primary btn-block btn-flat">Edit Assessment's Details</a>--}}
                {{--</div>--}}
                <div class="col-xs-2">
                    {!! Form::submit('Update Assessment Details', array('class' => 'btn btn-success btn-block btn-flat'))!!}
{{--                    <a href="{{ route('l_AssessmentQuestionOperation.show', $assessment->assessment_id) }}" class="btn btn-success btn-block btn-flat">Update Assessment</a>--}}
                </div>
            </div>
            {!! Form::close() !!}
        </div>

    </div>
@stop()
