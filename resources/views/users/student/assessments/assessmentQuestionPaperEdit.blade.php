
@extends('layout.layoutSubStudent')
@section('content')
</section>

    <div class="pad margin no-print">
        <div class="callout callout-info" style="margin-bottom: 0!important;">
            <h4><i class="fa fa-info"></i> Note:</h4>
            This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
        </div>
    </div>
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

<script>
    function ConfirmCancelEditAnswers()
    {
        var x = confirm("Are you sure you want to cancel editing your answers for this assessment?");
        if (x) {
            return true;
        }
        else {
            return false;
        }
    }
</script>

        <!-- Main content -->
        <section class="invoice">

        {{--{!! Form::open(array(--}}
             {{--'class' => 'form-horizontal',--}}
             {{--'route' => 'studentAssessmentDone.store')) !!}--}}
        {!! Form::model($assessmentAttemptData, array(
                       'method' => 'patch',
                       'route' => ['studentAssessmentAttempt.update', $assessmentAttemptData->assessmentattempt_id],
                       'class' => 'form-horizontal',
                       'onsubmit' => 'return ConfirmDelete()'
                   )) !!}
        <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i>
                            {{isset($assessmentAttemptData->assessment->classroom->subject)
                                ?strtoupper($assessmentAttemptData->assessment->classroom->subject->code." - ".$assessmentAttemptData->assessment->classroom->subject->name)
                                :"No Data Found"}}
                        <?php
                        $dateNow =  new DateTime();
                        ?>
                        <small class="pull-right">Date Attempt: {{$dateNow->format('Y-m-d H:i:s')}}</small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-2 invoice-col">
                    <address>
                        Lecturer : <br>
                        {{--Subject: <br>--}}
                        Section: <br>
                        Assessment: <br>
                        Time Limit: <br>
                        Total Questions: <br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <address>
                        <strong>
                            {{isset($assessmentAttemptData->assessment->classroom->user->lecturerprofile)
                                ?strtoupper($assessmentAttemptData->assessment->classroom->user->lecturerprofile->name):"No Data Found"
                            }}
                        </strong><br>
                        {{--<strong>--}}
                            {{--{{isset($assessmentAttemptData->assessment->classroom->subject)--}}
                                {{--?strtoupper($assessmentAttemptData->assessment->classroom->subject->code." - ".$assessmentAttemptData->assessment->classroom->subject->name)--}}
                                {{--:"No Data Found"--}}
                            {{--}}--}}
                        {{--</strong><br>--}}
                        <strong>
                            {{isset($assessmentAttemptData->assessment->classroom)?$assessmentAttemptData->assessment->classroom->section:"No Data Found"}}
                        </strong><br>
                        <strong>{{isset($assessmentAttemptData->assessment)?$assessmentAttemptData->assessment->assessmentname:"No Data Found"}}</strong><br>
                        <strong>{{isset($assessmentAttemptData->assessment)?$assessmentAttemptData->assessment->duration." minutes":"No Data Found"}}</strong><br>
                        <strong>{{isset($assessmentAttemptData->assessment)?$assessmentAttemptData->assessment->numberofquestion:"No Data Found"}}</strong><br>
                    </address>
                </div>
                <div class="col-sm-2 invoice-col">
                    <address>
                        Assessment EDIT: <br>
                        Total Marks: <br>
                        Total Questions: <br>
                        Time Limit: <br>
                        Open Date (24 Hours): <br>
                        Close Date (24 Hours):
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <address>
                        {{--<strong>{{$assessment->assessmentname}}</strong><br>--}}
                        {{--<strong>{{$assessment->assessmentmarks." %"}}</strong><br>--}}
                        {{--<strong>{{$assessment->numberofquestion}}</strong><br>--}}
                        {{--<strong>{{$assessment->duration}}</strong><br>--}}
                        {{--<strong>{{$assessment->starttime." ".$assessment->startdate}}</strong><br>--}}
                        {{--<strong>{{$assessment->endtime." ".$assessment->enddate}}</strong><br>--}}
                    </address>
                </div>
                <!-- /.col -->
            {{--<div class="col-sm-4 invoice-col">--}}
            {{--<b>Invoice #007612</b><br>--}}
            {{--<br>--}}
            {{--<b>Order ID:</b> 4F3S8J<br>--}}
            {{--<b>Payment Due:</b> 2/22/2014<br>--}}
            {{--<b>Account:</b> 968-34567--}}
            {{--</div>--}}
            <!-- /.col -->
            </div>
            <!-- /.row -->
        <?php $x = 1; ?>
        <!-- Table row -->
            <div class="row">
                @foreach($assessmentQsAs as $assessmentQA)
                    <div class="box box-solid box-default">
                        <div class="box-header with-border">
                            <div class="col-xs-7">
                                <h3 class="box-title">Question {{$x}}</h3>
                                <div class="box-tools pull-right">
                                    <!-- Buttons, labels, and many other things can be placed here! -->
                                    <!-- Here is a label for example -->
                                    {{--<span class="label label-primary">Label</span>--}}
                                </div><!-- /.box-tools -->
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="col-xs-2">
                                <h4>Question:</h4>
                            </div>
                            <div class="col-xs-6">
{{--                                {!! Form::textarea('question_field', nl2br(e($assessmentQA->question->question)), array('class' => 'form-control', 'readonly')) !!}--}}
                                {{--{!! Form::hidden('question_id[]', $assessmentQuestion->question_id !!}--}}

                                {!! nl2br(e($assessmentQA->question->question)) !!}<br>
                                {!! Form::text('assessmentanswer_id[]', $assessmentQA->assessmentanswer_id, array()) !!}<br>
                                {!! Form::text('question_id[]', $assessmentQA->question_id, array()) !!}<br>
                                gambar
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class="col-xs-2">
                                <h4>Answer:</h4>
                            </div>
                            <div class="col-xs-6">
                                {!! Form::textarea('s_answer[]', $assessmentQA->s_answer, array('class' => 'form-control')) !!}
{{--                                {!! Form::textarea('question_field', nl2br(e($assessmentQA->question->question)), array('class' => 'form-control', 'readonly')) !!}--}}
                            </div>
                        </div><!-- box-footer -->
                    </div><!-- /.box -->
                    <?php $x++; ?>
                @endforeach
                <label class="col-sm-3"></label>
                <div class="col-xs-3">
                    {{--{!! Form::hidden('assessmentattempt_id', $attempt_data->assessmentattempt_id) !!}--}}
                    {{--{!! Form::hidden('assessment_id', $assessment->assessment_id) !!}--}}
                    <a href="{{ route('studentAssessmentDone.edit', $assessmentAttemptData->assessmentattempt_id) }}" class="btn btn-primary btn-block btn-flat btn-lg" onclick="return ConfirmCancelEditAnswers()">Cancel</a>
{{--                    {!! Form::submit('Edit Answers', array('class' => 'btn btn-primary btn-block btn-flat btn-lg')) !!}--}}
                </div>
                <div class="col-xs-3">
                    {{--{!! Form::hidden('assessmentattempt_id', $attempt_data->assessmentattempt_id) !!}--}}
                    {{--{!! Form::hidden('assessment_id', $assessment->assessment_id) !!}--}}
                    {{--<a href="" class=""></a>--}}
                    {!! Form::submit('Update Answers', array('class' => 'btn btn-success btn-block btn-flat btn-lg')) !!}
                </div>
                    <label class="col-sm-3"></label>

            </div>
            <!-- /.row -->
            {!! Form::close() !!}

            <br><br>

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12">
                    <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                    <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
                    </button>
                    <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                        <i class="fa fa-download"></i> Generate PDF
                    </button>
                </div>
            </div>
        </section>
        <!-- /.content -->
        <div class="clearfix"></div>
        {{--</div>--}}
@stop()
