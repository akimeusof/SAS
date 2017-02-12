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
    <div class="row">
        <!-- Default box -->
        <div class="box">
            <div class="box-body">
                {!! Form::open(array('class' => 'form-horizontal')) !!}
                <div class ="form-group">
                    <label class ="col-sm-4 control-label"></label>
                    <div class="">
                        <label class ="control-label">
                           <center>
                               <h1>
                                   {{isset($classroom->subject)?$classroom->subject->code." - ":""}}
                                   <b><u>{{isset($classroom->subject)?$classroom->subject->name:""}}</u></b>
                                   {{--Section:--}}
                                   {{--<b><u></u></b>--}}

                               </h1>
                           </center>
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label"><h4>Lecturer:</h4></label>
                    <div class="col-xs-4">
                        <label class ="control-label">
                            <h4><b>
                                    {{isset($classroom->user->lecturerprofile)?$classroom->user->lecturerprofile->name:"No Data"}}
                                </b></h4>
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label"><h4>Section:</h4></label>
                    <div class="col-xs-4">
                        <label class ="control-label">
                            <h4><b>
                                    {{isset($classroom->section)?$classroom->section:""}}
                                </b></h4>
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label"><h4>Semester:</h4></label>
                    <div class="col-xs-4">
                        <label class ="control-label">
                            <h4><b>
                                    {{isset($classroom->semester)?$classroom->semester->semester:"No Data"}}
                                </b></h4>
                        </label>
                    </div>
                </div>

                <br>
                <div class ="form-group">
                    <label class="col-sm-4 control-label"></label>
                    <div class="col-xs-2">
{{--                        <a href="{{route('s_viewAllClassroom')}}" class="btn btn-default btn-block btn-flat">Back to List</a>--}}
                        <a href="{{URL::previous()}}" class="btn btn-default btn-block btn-flat">Back</a>
                    </div>
                    <div class="col-xs-2">
                        <a href="{{ route('studentAssessmentOperation.edit', $classroom->classroom_id) }}" class="btn btn-success btn-block btn-flat" onclick="return ConfirmAttempt()">Attempt Assessment</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="box box-solid box-info">
            <div class="box-header with-border">
                {{--<div class="col-xs-5">--}}
                    <h2 class="box-title">Assessment Summary</h2>
                    {{--<div class="box-tools pull-right">--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div><!-- /.box-header -->
            @if($attempted->count() >= 1)
                <?php $x = 1; ?>
                <div class="box-body">
                    <table id="example2" class="table table-hover">
                        <thead>
                        <tr>
                            <th><center>NO</center></th>
                            <th>ASSESSMENT NAME</th>
                            <th><center>MARKS</center></th>
                            <th><span class="pull-right">OPERATION</span></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($attempted as $attempt)
                                <tr>
                                    <td><center>{{$x}}</center></td>
                                    <td>{{isset($attempt->assessment)?$attempt->assessment->assessmentname:"No Data"}}</td>
                                    <td><center>
                                            @if($attempt->assessment->revealmarks == 0)
                                                Not Available
                                            @else
                                                <?php
                                                $getMarks = \App\AssessmentAnswer::where('assessmentattempt_id', $attempt->assessmentattempt_id)->get();
                                                $sumMarks = $getMarks->sum('marks');
                                                ?>
                                                {{number_format($sumMarks, 2)." / ".$attempt->assessment->assessmentmarks}}
                                            @endif
                                        </center>
                                    </td>
                                    <td>
                                        <span class="pull-right">
                                            <a class="btn btn-primary btn-block" href="{{route('s_assessmentDone', $attempt->assessmentattempt_id)}}">View Answers</a>
                                        </span>
                                    </td>
                                </tr>
                                <?php $x++; ?>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            @else
                <div class="box-body">
                    You have not taken any assessment for this class.
                </div>
            @endif
        </div><!-- /.box -->

    </div>

@stop()
