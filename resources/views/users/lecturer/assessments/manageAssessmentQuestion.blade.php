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
            <center><h3><b>Manage Assessment</b></h3></center>
        </div>
        <div class="box-body">
            {!! Form::open(array('class' => 'form-horizontal')) !!}
            <div class ="form-group">
                <label class ="col-sm-5 control-label">Subject Name:</label>
                <div class="col-xs-4">
                    <label class ="control-label">
                        {{isset($assessment->classroom->subject)?$assessment->classroom->subject->code." - ".$assessment->classroom->subject->name:""}}
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-5 control-label">Section:</label>
                <div class="col-xs-4">
                    <label class ="control-label">
                        {{isset($assessment->classroom)?$assessment->classroom->section:""}}
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-5 control-label">Assessment Name:</label>
                <div class="col-xs-4">
                    <label class ="control-label">
                        {{$assessment->assessmentname}}
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-5 control-label">Number of Questions:</label>
                <div class="col-xs-4">
                    <label class ="control-label">
                       {{isset($questionsAdded)?$questionsAdded->count()." / ".$assessment->numberofquestion:"0 / ".$assessment->numberofquestion}}
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-5 control-label">Marks Inserted:</label>
                <div class="col-xs-4">
                    <label class ="control-label">
                        {{isset($questionsAdded)?$questionsAdded->sum('marks')." / ".$assessment->assessmentmarks:"0 / ".$assessment->assessmentmarks}}
                    </label>
                </div>
            </div>
            {{--<div class ="form-group">--}}
                {{--<label class ="col-sm-4 control-label">Number of Questions:</label>--}}
                {{--<div class="col-xs-4">--}}
{{--                    Question(s) Selected: <b>{{isset($questionsAdded)?$questionsAdded->count():"0"}}</b>/<b>{{$assessment->numberofquestion}}</b><br><br>--}}

                    {{--<label class ="control-label">--}}
                        {{--{{isset($questionsAdded)?$questionsAdded->count()." / ".$assessments->numberofquestion:"0 / ".$assessments->numberofquestion}}--}}
                    {{--</label>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class ="form-group">
                <label class ="col-sm-4 control-label"></label>
                <div class="col-xs-1">
                    <a class="btn btn-default btn-block btn-flat" href="{{ route('lecturerAssessmentOperation.show', $assessment->assessment_id) }}">Back</a>
                </div>
                <div class="col-xs-2">
                    <a href="{{ route('l_AssessmentQuestionRemove.edit', $assessment->assessment_id) }}" class="btn btn-primary btn-block btn-flat">Remove Questions</a>
                </div>
                <div class="col-xs-2">
                    <a href="{{ route('l_AssessmentQuestionOperation.edit', $assessment->assessment_id) }}" class="btn btn-primary btn-block btn-flat">Add Questions</a>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
        <!-- /.box-header -->
        <div class="box-header">
            <h3 class="box-title"><b>Questions Added</b></h3>
            <span class="pull-right">
                <a href="{{ route('l_manageQuestionsMarks', $assessment->assessment_id) }}" class="btn btn-primary btn-block btn-flat">Edit Marks</a>
            </span>
        </div>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th><center>NO</center></th>
                    <th>QUESTION</th>
                    <th>ANSWER</th>
                    <th>CHAPTER</th>
                    <th><center>MARKS</center></th>
                    <th><span class="pull-right">OPERATIONS</span></th>
                </tr>
                @if($questionsAdded->count() > 0)
                    <?php $x = 1; ?>
                    @foreach($questionsAdded as $questionAdded)
                        <tr>
                            <td><center>{{$x}}</center></td>
                            <td>{!! isset($questionAdded->question)?nl2br(e($questionAdded->question->question)):"No Data Found" !!}</td>
                            <td>{!! isset($questionAdded->question)?nl2br(e($questionAdded->question->answer)):"" !!}</td>
                            <td>{{isset($questionAdded->question->chapter)?$questionAdded->question->chapter->chapter_no." - ".$questionAdded->question->chapter->chapter_name:""}}</td>
                            <td>
                                <center>
                                    {{$questionAdded->marks}}
                                </center>
                            </td>
                            <td>
                                    <span class="pull-right">
                                        <a href="{{ route('l_AssessmentQuestionOperation.show', $assessment->assessment_id) }}" class="btn btn-info btn-flat">View Question Details</a>
                                    </span>
                            </td>
                        </tr>
                        <?php $x++; ?>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">No questions selected for this assessment.</td>
                    </tr>
                @endif

            </table>
        </div>
    </div>

@stop()
