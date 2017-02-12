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
                <h3><b>Manage Questions Marks</b></h3>
            </center>
        </div>
        <div class="box-header">
            {!! Form::open(array('class' => 'form-horizontal', 'route' => 'l_handleQuestionsMarks')) !!}
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
                <label class ="col-sm-5 control-label"><h4>Assessment Name:</h4></label>
                <div class="col-xs-4">
                    <label class ="control-label">
                        <h4><b>
                                {{$assessment->assessmentname}}
                            </b></h4>
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-5 control-label"><h4>Number of Questions:</h4></label>
                <div class="col-xs-4">
                    <label class ="control-label">
                        <h4><b>
                                {{isset($questionsAdded)?$questionsAdded->count()." / ".$assessment->numberofquestion:"0 / ".$assessment->numberofquestion}}
                            </b></h4>
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-5 control-label"><h4>Marks Inserted:</h4></label>
                <div class="col-xs-4">
                    <label class ="control-label">
                        <h4><b>
                                {{isset($questionsAdded)?$questionsAdded->sum('marks')." / ".$assessment->assessmentmarks:"0 / ".$assessment->assessmentmarks}}
                            </b></h4>
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-5 control-label"></label>
                {{--<div class="col-xs-2">--}}
                    {{--<a href="{{ route('l_AssessmentQuestionRemove.edit', $assessment->assessment_id) }}" class="btn btn-primary btn-block btn-flat">Remove Questions</a>--}}
                {{--</div>--}}
                <div class="col-xs-4">
                   <script type="text/javascript">
                        function CountMarks($totalmarks){
//                            var arr = document.getElementsByTagName('input');
                            var arr = document.getElementsByName('marks[]');
                            var tot=0;
                            for(var i=0;i<3;i++){
                                if(parseInt(arr[i].value))
                                    tot += parseInt(arr[i].value);
                            }
                            if(tot > $totalmarks) {
                                alert("You have exceeded this total marks limit for this assessment. Marks Inserted: " + tot + " / " + $totalmarks);
                                return false;
                            }
                            else{
                                alert("Marks Inserted: " + tot + " / " + $totalmarks);
                                return true;
                            }
                        }

                    </script>
                    {!! Form::submit('Proceed', array('class' => 'btn btn-block btn-flat btn-success', 'onclick' => 'return CountMarks('.$assessment->assessmentmarks.')')) !!}
                </div>
            </div>

            {{--<h1><b>Manage Questions</b></h1><br>--}}
            <h1 class="box-title"><b>Questions Added</b></h1>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>NO</th>
                    <th>QUESTION</th>
                    <th>ANSWER</th>
                    <th>CHAPTER</th>
                    <th width="5%">MARKS</th>
                    <th><span class="pull-right">OPERATIONS</span></th>
                </tr>
                @if($questionsAdded->count() > 0)
                    <?php $x = 1; ?>
                    @foreach($questionsAdded as $questionAdded)
                        <tr>
                            <td>{{$x}}</td>
                            <td>{!! isset($questionAdded->question)?nl2br(e($questionAdded->question->question)):"No Data Found" !!}</td>
                            <td>{!! isset($questionAdded->question)?nl2br(e($questionAdded->question->answer)):"" !!}</td>
                            <td>{{isset($questionAdded->question->chapter)?$questionAdded->question->chapter->chapter_no." - ".$questionAdded->question->chapter->chapter_name:""}}</td>
                            <td>
                                @if(isset($questionAdded->marks))
                                    {!! Form::hidden('assessmentquestion_id[]', $questionAdded->assessmentquestion_id ) !!}
                                    {!! Form::hidden('assessment_id', $questionAdded->assessment->assessment_id ) !!}
                                    {!! Form::number('marks[]', $questionAdded->marks, ['class' => 'form-control', 'min' => 0, 'max' => 100]) !!}
                                    Leave as 0 to edit later.
                                @else
                                    {!! Form::hidden('marks[]', null) !!}
                                @endif
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
            {!! Form::close() !!}
        </div>
    </div>

@stop()
