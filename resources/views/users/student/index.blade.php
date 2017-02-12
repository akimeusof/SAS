@extends('layout.layoutSubStudent')
@section('content')
</section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Welcome {{strtoupper($user->username)." !"}}</h3>
                {{--untuk button collapsed--}}
                {{--<div class="box-tools pull-right">--}}
                    {{--<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">--}}
                        {{--<i class="fa fa-minus"></i></button>--}}
                    {{--<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">--}}
                        {{--<i class="fa fa-times"></i></button>--}}
                {{--</div>--}}
            </div>
            <div class="box-body">
                @if($classEnrolled->count() >= 1)
                    @foreach($classEnrolled as $class)
                        <div class="box box-default box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{isset($class->classroom->subject)?$class->classroom->subject->code." - ".$class->classroom->subject->name:"No Data"}}</h3>
                                <div class="box-tools pull-right">
                                    {{--<span class="label label-default">--}}
                                        <a href="{{route('s_classDetails', $class->classroom_id)}}" class="btn btn-success btn-flat btn-block">
                                            Class Details
                                        </a>
                                    {{--</span>--}}
                                </div>
                                {{--untuk button collapsed--}}
                                {{--<div class="box-tools pull-right">--}}
                                {{--<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">--}}
                                {{--<i class="fa fa-minus"></i></button>--}}
                                {{--<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">--}}
                                {{--<i class="fa fa-times"></i></button>--}}
                                {{--</div>--}}
                            </div>
                            <div class="box-body">
                                <?php
                                    //to get the assessment result
                                    $assessment_id_array = Array();
                                    $assessments = App\Assessment::where('classroom_id', $class->classroom_id)->get();
                                    foreach ($assessments as $assessment){
                                        $assessment_id_array[] = $assessment->assessment_id;
                                    }
                                    $assessmentAttempts = \App\AssessmentAttempt::join('assessments', 'assessmentattempts.assessment_id', '=', 'assessments.assessment_id')
                                        ->select('assessmentattempts.*')
                                        ->where('assessmentattempts.user_id', \Auth::user()->id, 'AND')
                                        ->whereIn('assessmentattempts.assessment_id', $assessment_id_array)
                                        ->orderBy('assessments.assessmentname', 'asc')
                                        ->get();
//                                    dd($assessmentAttempts);
//                                    echo $assessmentAttempts;
                                    ?>
                                <table id="example2" class="table table-hover">
                                    {{--<thead>--}}
                                    {{--<tr>--}}
                                        {{--<th><center>NO</center></th>--}}
                                        {{--<th>ASSESSMENT NAME</th>--}}
                                        {{--<th><center>MARKS</center></th>--}}
                                        {{--<th><span class="pull-right">OPERATION</span></th>--}}
                                    {{--</tr>--}}
                                    {{--</thead>--}}
                                    {{--<tbody>--}}
                                    <?php
                                            if($assessmentAttempts->count() >= 1){
                                                $x = 1; ?>
                                                <thead>
                                                <tr>
                                                    <th><center>NO</center></th>
                                                    <th>ASSESSMENT NAME</th>
                                                    <th><center>MARKS</center></th>
                                                    <th><span class="pull-right">OPERATION</span></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                    <?php
                                                foreach($assessmentAttempts as $assessmentAttempt){?>

                                                <tr>
                                                    <td><center>{{$x}}</center></td>
                                                    <td>{{isset($assessmentAttempt->assessment)?$assessmentAttempt->assessment->assessmentname:"No Data"}}</td>
                                                    <td>
                                                        <center>
                                                            @if($assessmentAttempt->assessment->revealmarks == 0)
                                                                Not Available
                                                            @else
                                                                <?php
                                                                    $getMarks = \App\AssessmentAnswer::where('assessmentattempt_id', $assessmentAttempt->assessmentattempt_id)->get();
                                                                    $sumMarks = $getMarks->sum('marks');
                                                                ?>
                                                                {{number_format($sumMarks, 2)." / ".$assessmentAttempt->assessment->assessmentmarks}}
                                                            @endif
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <span class="pull-right">

                                                        </span>
                                                    </td>
                                                </tr>
                                    <?php
                                                $x++;
                                                }
                                            }else { ?>
                                                <tr>
                                                    <td colspan="4">
                                                        No Assessment record for this class.
                                                    </td>
                                                </tr>
                                    <?php
                                            }
                                            ?>
                                    </tbody>
                                </table>

                            </div>
                            <!-- /.box-body -->
                            {{--<div class="box-footer">--}}
                                {{--Footer--}}
                            {{--</div>--}}
                            <!-- /.box-footer-->
                        </div>
                    @endforeach
                @else
                    <div class="box box-info box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Classes</h3>
                            {{--untuk button collapsed--}}
                            {{--<div class="box-tools pull-right">--}}
                            {{--<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">--}}
                            {{--<i class="fa fa-minus"></i></button>--}}
                            {{--<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">--}}
                            {{--<i class="fa fa-times"></i></button>--}}
                            {{--</div>--}}
                        </div>
                        <div class="box-body">
                            You are not enrolled to any class.
                        </div>
                        <!-- /.box-body -->
                        <!-- /.box-footer-->
                    </div>
                @endif
            </div>
            <!-- /.box-body -->
            {{--<div class="box-footer">--}}
                {{--Footer--}}
            {{--</div>--}}
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

@stop()