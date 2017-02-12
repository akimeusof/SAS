@extends('layout.layoutSubStudent')
@section('content')
</section>

<script>
    function ConfirmAttempt()
    {
        var x = confirm("Are you sure you want to attempt this assessment?");
        if (x) {
            return true;
        }
        else {
            return false;
        }
    }
</script>

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
        <div class="box-body">
            {!! Form::open(array('class' => 'form-horizontal')) !!}
            <div class ="form-group">
                {{--<label class ="col-sm-4 control-label"></label>--}}
                {{--<div class="">--}}
                    <center>
                        <h1>Assessment: <b><u>{{isset($assessment)?$assessment->assessmentname:"No Data"}}</u></b></h1>
                    </center>
                    {{--<label class ="control-label"><h1>Assessment: <b><u>{{isset($assessment)?$assessment->assessmentname:"No Data"}}</u></b></h1></label>--}}
                {{--</div>--}}
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"><h4>Subject Name:</h4></label>
                <div class="col-xs-4">
                    <label class ="control-label">
                        <h4><b>
                                {{isset($assessment->classroom->subject)?$assessment->classroom->subject->code." - ".$assessment->classroom->subject->name:"No Data"}}
                            </b></h4>
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"><h4>Section:</h4></label>
                <div class="col-xs-4">
                    <label class ="control-label">
                        <h4><b>
                                {{isset($assessment->classroom)?$assessment->classroom->section:"No Data"}}
                            </b></h4>
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"><h4>Lecturer Name:</h4></label>
                <div class="col-xs-4">
                    <label class ="control-label">
                        <h4><b>
                                {{isset($assessment->classroom->user->lecturerprofile)?$assessment->classroom->user->lecturerprofile->name:"No Data"}}
                            </b></h4>
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"><h4>Total Marks:</h4></label>
                <div class="col-xs-4">
                    <label class ="control-label">
                        <h4><b>
                                {{isset($assessment)?$assessment->assessmentmarks:"No Data"}}
                            </b></h4>
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"><h4>Number of Questions:</h4></label>
                <div class="col-xs-4">
                    <label class ="control-label">
                        <h4><b>
                                {{isset($assessment)?$assessment->numberofquestion:"No Data"}}
                            </b></h4>
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"><h4>Time Limit:</h4></label>
                <div class="col-xs-4">
                    <label class ="control-label">
                        <h4><b>
                                {{isset($assessment)?$assessment->duration." minute(s)":"No Data"}}
                            </b></h4>
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"><h4>Open Date:</h4></label>
                <div class="col-xs-4">
                    <label class ="control-label">
                        <h4><b>
                                {{isset($assessment)?$assessment->start:"No Data"}}
                            </b></h4>
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"><h4>Close Date:</h4></label>
                <div class="col-xs-4">
                    <label class ="control-label">
                        <h4><b>
                                {{isset($assessment)?$assessment->end:"No Data"}}
                            </b></h4>
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"><h4>Remarks:</h4></label>
                <div class="col-xs-4">
                    <label class ="control-label">
                        <h4><b>
                                {!! isset($assessment)?$assessment->remarks:"No Data" !!}
                            </b></h4>
                    </label>
                </div>
            </div>
            <br>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"></label>
                <div class="col-xs-2">
                    <a href="{{ route('s_viewAllAssessment') }}" class="btn btn-default btn-block btn-flat">Back to List</a>
                </div>
                <div class="col-xs-2">
                    @if($checkAttempt == null)
                        {{--go to page jawab soalan--}}
                        <a href="{{ route('studentAssessmentOperation.edit', $assessment->assessment_id) }}" class="btn btn-success btn-block btn-flat" onclick="return ConfirmAttempt()">Attempt Assessment</a>
                    @else
                        {{--go to page review jawapan yang dia buat--}}
                        <a class="btn btn-primary btn-block btn-lg" href="{{route('s_assessmentDone', $checkAttempt->assessmentattempt_id)}}">View Answers</a>
                    @endif
                </div>
            </div>
            {!! Form::close() !!}
        </div>

    </div>
@stop()
