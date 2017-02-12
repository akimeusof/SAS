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
       <div class="box-body">
        <div class="col-xs-4">
            {!! Form::open(array('class' => 'form-horizontal')) !!}
            <div class ="form-group">
                <label class ="control-label"></label>
                <div class="col-xs-10">
                        <center><h3>Assessment: <b><u>{{$assessment->assessmentname}}</u></b></h3></center>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-3">Code:</label>
                <div class="col-xs-9">
                    <label>
                        {{isset($assessment->classroom->subject)?$assessment->classroom->subject->code:""}}
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-3">Name:</label>
                <div class="col-xs-9">
                    <label>
                        {{isset($assessment->classroom->subject)?$assessment->classroom->subject->name:""}}
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-3">Section:</label>
                <div class="col-xs-9">
                    <label>
                        {{isset($assessment->classroom)?$assessment->classroom->section:""}}
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-3">Total Marks:</label>
                <div class="col-xs-9">
                    <label>
                        {{$assessment->assessmentmarks}}
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-3">Questions:</label>
                <div class="col-xs-9">
                    <label>
                        {{$assessment->numberofquestion}}
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-3">Time Limit:</label>
                <div class="col-xs-9">
                    <label>
                        {{$assessment->duration." minute(s) "}}
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-3">Open:</label>
                <div class="col-xs-9">
                    <label>
                        {{$assessment->start}}
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-3">Close:</label>
                <div class="col-xs-9">
                    <label>
                        {{$assessment->end}}
                    </label>
                </div>
            </div>
            @if($assessment->remarks != null)
                <div class ="form-group">
                    <label class ="col-sm-3">Remarks:</label>
                    <div class="col-xs-9">
                        <label>
                            {!! isset($assessment->remarks)?nl2br(e($assessment->remarks)):"" !!}
                        </label>
                    </div>
                </div>
            @endif
            <div class ="form-group">
                <label class ="col-sm-3">Marks Reveal:</label>
                <div class="col-xs-9">
                    <label>
                        @if($assessment->revealmarks == 0)
                            Yes
                        @else
                            No
                        @endif
                    </label>
                </div>
            </div>
            <br>

            {!! Form::close() !!}
            <div class ="form-group">
                <label class ="control-label"></label>
                <div class="col-xs-10">
                    <center><h3><b>Menu</b></h3></center>
                </div>
            </div>
            <div class ="form-group">
                <label class ="control-label"></label>
                <div class="col-xs-10">
                    <a href="{{ route('lecturerAssessmentOperation.edit', $assessment->assessment_id) }}" class="btn btn-default btn-block btn-flat">Edit Assessment's Details</a><br>
                </div>
            </div>
            <div class ="form-group">
                <label class ="control-label"></label>
                <div class="col-xs-5">
                    <a href="{{ route('l_editAssessmentOpenDate', $assessment->assessment_id) }}" class="btn btn-default btn-block btn-flat">Edit Open Date</a><br>
                </div>
                <div class="col-xs-5">
                    <a href="{{ route('l_editAssessmentCloseDate', $assessment->assessment_id)}}" class="btn btn-default btn-block btn-flat">Edit Close Date</a><br>
                </div>
            </div>
            <div class ="form-group">
                <label class ="control-label"></label>
                <div class="col-xs-10">
                    <a href="{{ route('l_AssessmentQuestionOperation.show', $assessment->assessment_id) }}" class="btn btn-default btn-block btn-flat">Manage Assessment's Questions</a><br>
                </div>
            </div>
            <div class ="form-group">
                <label class ="control-label"></label>
                <div class="col-xs-10">
                    <script>
                        function ConfirmReveal()
                        {
                            var x = confirm("Are you sure you want to reveal assessment's marks to the student??");
                            if (x) {
                                return true;
                            }
                            else {
                                return false;
                            }
                        }
                    </script>
                    <a href="{{ route('l_revealMarks', $assessment->assessment_id) }}" onClick="return ConfirmReveal()" class="btn btn-default btn-block btn-flat">Reveal Assessment's Marks</a><br>
                </div>
            </div>
        </div>

        <div class="col-xs-8">
            {{--<div class="box">--}}
                <div class="box-header">
                    <h3 class="box-title">List of <b>Student(s)</b> Attempted</h3>
                    <span class="pull-right">
                        <a href="{{ route('lecturerClassroomOperation.show', $assessment->classroom_id) }}" class="btn btn-primary btn-block btn-flat">View Class Details</a>
                    </span>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        @if($studentsAttempted->count() >= 1)
                            <thead>
                            <tr>
                                <th width="3%"><center>NO</center></th>
                                <th width="10%"><center>ID</center></th>
                                <th>NAME</th>
                                <th><center>MARKS</center></th>
                                <th><center>Highest Average Similarity</center></th>
                                <th><span class="pull-right">OPERATION</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $x = 1; ?>
                            @foreach($studentsAttempted as $studentAttempted)
                                <tr>
                                    <td><center>{{$x}}</center></td>
                                    <td>
                                        <center>
                                            <a href="{{route('l_studentOperation.index', $studentAttempted->user->id)}}">{{isset($studentAttempted->user->studentprofile)?$studentAttempted->user->studentprofile->id:"No Data Found"}}</a>
                                        </center>
                                    </td>
                                    {{--                            <td><a href="{{route('l_toCompare.index', $studentAttempted->user->id)}}">{{isset($studentAttempted->user->studentprofile)?$studentAttempted->user->studentprofile->id:"No Data Found"}}</a></td>--}}
                                    <td>{{isset($studentAttempted->user->studentprofile)?$studentAttempted->user->studentprofile->name:"No Data Found"}}</td>
                                    <td>
                                        <center>
                                            <?php
                                                $getMarks = \App\AssessmentAnswer::where('assessmentattempt_id', $studentAttempted->assessmentattempt_id)->get();
                                                $sumMarks = $getMarks->sum('marks');
                                                echo $sumMarks." / ".$studentAttempted->assessment->assessmentmarks;
                                            ?>
                                        </center>
                                    </td>
                                    <td>
                                        <center>

                                            <?php
                                                $otherStudentsAttempted = \App\AssessmentAttempt::where('assessmentattempt_id', '!=', $studentAttempted->assessmentattempt_id, 'AND')
                                                                            ->where('assessment_id', $studentAttempted->assessment_id)->get();
                                                $getAnswers = \App\AssessmentAnswer::where('assessmentattempt_id', $studentAttempted->assessmentattempt_id)->get();
                                                $compare_sm_array = array();
                                                $compare_swg_array = array();
                                                $collectArray = array();
                                                foreach ($otherStudentsAttempted as $otherStudentAttempted){
                                                    foreach ($getAnswers as $getAnswer){
                                                        $studentAttempted_answer = $getAnswer->s_answer;
                                                        $findOtherAnswer = \App\AssessmentAnswer::where('assessmentattempt_id', $otherStudentAttempted->assessmentattempt_id, 'AND')
                                                                ->where('assessmentquestion_id', $getAnswer->assessmentquestion_id)->first();
                                                        $compare_swg = new App\SWGCompare();
                                                        $compare_swg = $compare_swg->compare($studentAttempted_answer, $findOtherAnswer->s_answer);
                                                        $formattedSWG = number_format($compare_swg*100, 2);
                                                        $compare_swg_array[] = $formattedSWG;
                                                    }
                                                    $collect = collect([
                                                        'owner' => $otherStudentAttempted->assessmentattempt_id, 'avgSimilaritySWG' => number_format((array_sum($compare_swg_array)/$getAnswers->count()), 2)
                                                    ]);

                                                    $collectArray[] = $collect;
                                                    unset($compare_swg_array);
                                                    unset($collect);
                                                }
                                            $collection = collect($collectArray);
                                            $max = $collection->max('avgSimilaritySWG');
                                            $get = $collection->where('avgSimilaritySWG', $max)->first();
                                            $owner = $get->get('owner');
                                            $ownerData = \App\AssessmentAttempt::where('assessmentattempt_id', $owner)->first();
                                        ?>
                                            <a href="{{route('l_compareTwoStudent', [$assessment->assessment_id, $studentAttempted->assessmentattempt_id, $ownerData->assessmentattempt_id])}}" class="">{{isset($ownerData->user->studentprofile)?$ownerData->user->studentprofile->name." - ".$max." %":""}}</a>
                                        </center>
                                    </td>
                                    <td><span class="pull-right">
                                    <a href="{{route('l_studentAnswer.show', $studentAttempted->assessmentattempt_id)}}" class="btn btn-primary">View Answers</a>
                                    <a href="{{route('l_similarityChecker.show', $studentAttempted->assessmentattempt_id)}}" class="btn btn-primary">Similarity Check</a>
                                    </span>
                                    </td>
                                </tr>
                                <?php $x++; ?>
                            @endforeach
                            </tbody>
                        @else
                            <thead>
                            <tr>
                                <td>No student attempted this assessment to date.</td>
                            </tr>
                            </thead>
                        @endif

                    </table>
                {{--</div>--}}
            </div>
        </div>
    </div>
</div>
    {{--first div--}}
@stop()
