
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
            <h3 class="">
                <b>List</b> of <b>Assessments</b> for: <b>{{strtoupper(\Auth::user()->studentprofile->name)}}</b>
            </h3>
        </div>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                @if($assessmentsAvailable->count() >= 1)
                <tr>
                    <th width="3%"><center>NO</center></th>
                    <th>CLASS (SECTION-CODE-SUBJECT)</th>
                    <th><center>ASSESSMENT NAME</center></th>
                    <th><center>ASSESSMENT MARKS</center></centr></th>
                    <th><center>NO OF QUESTIONS</center></th>
                    <th><center>TIME LIMIT</center></th>
                    <th><center>OPEN</center></th>
                    <th><center>CLOSE</center></th>
                    <th><center>STATUS</center></th>
                    <th><center>OPERATION</center></th>
                </tr>
                </thead>
                <tbody>
                <?php $x = 1; ?>
                @foreach($assessmentsAvailable as $assessment)
                    <tr>
                        <td><center>{{$x}}</center></td>
                        <td>
                            {{isset($assessment->classroom->subject)?
                                $assessment->classroom->section." - ".
                                $assessment->classroom->subject->code." - ".
                                $assessment->classroom->subject->name:""
                                }}
                        </td>
                        <td><center>{{$assessment->assessmentname}}</center></td>
                        <td><center>{{$assessment->assessmentmarks}}</center></td>
                        <td><center>{{$assessment->numberofquestion}}</center></td>
                        <td><center>{{$assessment->duration." minute(s)"}}</center></td>
                        <td><center>{{$assessment->start}}</center></td>
                        <td><center>{{$assessment->end}}</center></td>
                        <td><center>
                            <?php
                            $now = \Carbon\Carbon::now();
                            ?>
                            @if($now >= $assessment->start && $now <= $assessment->end)
                                <b>Active</b>
                            @else
                                <b>Not Active</b>
                            @endif
                            </center>
                        </td>
                        <td>
                           <center>
                               <?php
                               $checkAttempt = App\AssessmentAttempt::where('assessment_id', $assessment->assessment_id, 'AND')->where('user_id', $user->id, 'AND')->where('status', 1)->first();
                               $now = \Carbon\Carbon::now();
                               ?>

                               @if($checkAttempt != null)
                                   <a class="btn btn-primary btn-block btn-lg" href="{{route('s_assessmentDone', $checkAttempt->assessmentattempt_id)}}">View Answers</a>
                               @else
                                   @if($now >= $assessment->start && $now <= $assessment->end)
                                       <a class="btn btn-success btn-block btn-lg" href="{{route('studentAssessmentOperation.show', $assessment->assessment_id)}}">View & Attempt</a>
                                   @else
                                       <a class="btn btn-default btn-block btn-lg disabled" href="#">Assessment Not Available</a>
                                   @endif
                               @endif
                           </center>
                        </td>
                    </tr>
                    <?php $x++; ?>
                @endforeach
                </tbody>
                @else
                    <thead>
                        <tr>
                           <th colspan="10">
                               No Available Assessment.
                           </th>
                        </tr>
                    </thead>
                @endif
            </table>

        </div>
        {{--box-body--}}

    </div>
    <!-- /.box -->
@stop()
