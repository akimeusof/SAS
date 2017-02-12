@extends('layout.layoutSubStudent')
@section('content')
</section>
<!-- Main content -->
<?php
$checkAnswers = App\AssessmentAnswer::where('assessmentattempt_id', $attempt_data->assessmentattempt_id)->get();
if($checkAnswers->count() >= 1){
    return "haha";
}else {
?>
<section class="invoice">
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
    {!! Form::open(array(
         'class' => 'form-horizontal',
         'route' => 'studentAssessmentAttempt.store',
         'id' => 'formAssessment',
         'name' => 'formAssessment',
         'onSubmit' => 'return submit()')) !!}
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <div>
                    <span class="pull-right">
                        <div style="font-weight: bold; align:right; font-size: 24px;" id="quiz-time-left"></div>
                        <script type="text/javascript">
                        var max_time = "<?php echo $assessment->duration ?>";
                        var c_seconds  = 0;
                        var total_seconds =60*max_time;
                        max_time = parseInt(total_seconds/60);
                        c_seconds = parseInt(total_seconds%60);
                        document.getElementById("quiz-time-left").innerHTML='Time Left: ' + max_time + ' minutes ' + c_seconds + ' seconds';
                        function init(){
                            document.getElementById("quiz-time-left").innerHTML='Time Left: ' + max_time + ' minutes ' + c_seconds + ' seconds';
                            setTimeout("CheckTime()",999);
                        }
                        function CheckTime(){
                            document.getElementById("quiz-time-left").innerHTML='Time Left: ' + max_time + ' minutes ' + c_seconds + ' seconds' ;
                            if(total_seconds <=0){
                                alert("Time is up. Press OK to proceed.");
                                setTimeout('document.formAssessment.submit()',1);
//                                    document.formAssessment.submit();

                            } else {
                                total_seconds = total_seconds - 1;
                                max_time = parseInt(total_seconds / 60);
                                c_seconds = parseInt(total_seconds % 60);
                                setTimeout("CheckTime()", 999);
                            }

                        }
                        function submit(){
                            setTimeout('document.formAssessment.submit()',1);
                            form.submitButton.disabled = true;
                        }
                        init();
                        </script>
                    </span>
                </div>
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> {{$assessment->classroom->subject->code." - ".$assessment->classroom->subject->name." Section: ".strtoupper($assessment->classroom->section)}}
                    <?php
                        $dateNow =  new DateTime();
                            ?>
                </h2>

{{--                        <small class="pull-right"><Date></Date>: {{$dateNow->format('Y-m-d H:i:s')}}</small>--}}
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-1 invoice-col">
                <address>
                    Name: <br>
                    Matric ID: <br>
                    Programme: <br>
                    E - Mail: <br>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-5 invoice-col">
                <address>
                    <strong>{{isset($user->studentprofile)?$user->studentprofile->name:"No Data"}}</strong><br>
                    <strong>{{isset($user->studentprofile)?$user->studentprofile->id:"No Data"}}</strong><br>
                    <strong>{{isset($user->studentprofile->programme)?$user->studentprofile->programme->name:"No Data"}}</strong><br>
                    <strong>{{isset($user->studentprofile)?$user->studentprofile->email:"No Data"}}</strong><br>
                </address>
            </div>
            <div class="col-sm-1 invoice-col">
                <address>
                    Assessment: <br>
                    Total Marks: <br>
                    Total Questions: <br>
                    Time Limit: <br>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-5 invoice-col">
                <address>
                    <strong>{{$assessment->assessmentname}}</strong><br>
                    <strong>{{$assessment->assessmentmarks}}</strong><br>
                    <strong>{{$assessment->numberofquestion}}</strong><br>
                    <strong>{{$assessment->duration." minutes(s)"}}</strong><br>
                </address>
            </div>
        </div>
        <!-- /.row -->
        <?php $x = 1; ?>
        <!-- Table row -->
        <div class="row">
            @foreach($assessmentQuestions as $assessmentQuestion)
            <div class="box box-solid box-default">
                    <div class="box-header with-border">
                        <div class="col-xs-5">
                            <h3 class="box-title">Question {{$x}}</h3>
                                <div class="box-tools pull-right">
                                </div>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-xs-5">
                            {!! nl2br(e($assessmentQuestion->question->question)) !!}<br>
                            @if($assessmentQuestion->question->diagram != null)
                                <a href="">
                                    <img src="/uploads/question_diagram/{{$assessmentQuestion->question->diagram}}" class="center-block user-image" title="">
                                </a>
                            @endif
                            {!! Form::hidden('assessmentquestion_id[]', $assessmentQuestion->assessmentquestion_id) !!}
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div class="col-xs-5"><h4><b>
                            {!! Form::textarea('s_answer[]', null, array('class' => 'form-control', 'placeholder' => 'Expected Answer')) !!}
                                </b></h4>
                        </div>
                    </div><!-- box-footer -->
                </div><!-- /.box -->
            <?php $x++; ?>
            @endforeach
                <div class="col-xs-5">
                    {!! Form::hidden('assessmentattempt_id', $attempt_data->assessmentattempt_id) !!}
                    {!! Form::hidden('assessment_id', $assessment->assessment_id) !!}
                    <script>
                        function ConfirmSubmit()
                        {
                            var x = confirm("Are you sure you want to submit your answer(s) now? You cannot edit your answer once you have submitted.");
                            if (x)
                                return true;
                            else
                                return false;
                        }
                    </script>
                    <input type="submit" value="Submit" name="submitButton" onclick="return ConfirmSubmit();"class="btn btn-success btn-block btn-flat btn-lg">
{{--                        {!! Form::submit('Submit Answers', 'submitButton', array('class' => 'btn btn-success btn-block btn-flat btn-lg')) !!}--}}
                </div>

        </div>
        <!-- /.row -->
    {!! Form::close() !!}

        <br><br>

    <!-- this row will not appear when printing -->
        {{--<div class="row no-print">--}}
            {{--<div class="col-xs-12">--}}
                {{--<a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>--}}
                {{--<button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment--}}
                {{--</button>--}}
                {{--<button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">--}}
                    {{--<i class="fa fa-download"></i> Generate PDF--}}
                {{--</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
        {{--</div>--}}
<?php } ?>
@stop()
