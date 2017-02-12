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
    <script>
//        function checkboxes($max)
//        {
//            var inputElems = document.getElementsByTagName("input"),
//                    count = 0;
//
//            for (var i=0; i<inputElems.length; i++) {
//                if (inputElems[i].type == "checkbox" && inputElems[i].checked == true){
//                    count++;
//                }
//            }
//            if(count > $max){
//                alert("You have exceeded this assessment question limit. Question(s) Selected: "+count+" / "+$max);
//                return false;
//            }
//            else{
//                alert("Question(s) Selected: " + count + " / " + $max);
//                return true;
//            }
//        }
        function ConfirmDelete($assessmentname)
        {
            var inputElems = document.getElementsByTagName("input"),
                    count = 0;

            for (var i=0; i<inputElems.length; i++) {
                if (inputElems[i].type == "checkbox" && inputElems[i].checked == true){
                    count++;
                }
            }
            var x = confirm("Are you sure you want to remove "+ count +" question(s) from assessment " + $assessmentname +"?");
            if (x) {
                return true;
            }
            else {
                return false;
            }
        }
    </script>
    {!! Form::model($assessment, array(
                               'method' => 'patch',
                               'route' => ['l_AssessmentQuestionRemove.update', $assessment->assessment_id],
                               'class' => 'form-horizontal',
                               'onsubmit' => 'return ConfirmDelete("'.$assessment->assessmentname.'")'
                           )) !!}
    <div class="box">
        <div class="box-header">
            <center><h3><b>Edit Assessment Questions</b></h3></center>
        </div>
        <div class="box-header">
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
                @if($questionsAdded->count()>0)
                    <label class ="col-sm-5 control-label"></label>
                    <div class="col-xs-2">
                        <a href="{{ route('l_AssessmentQuestionOperation.show', $assessment->assessment_id) }}" class="btn btn-default btn-block btn-flat">Back</a>
                    </div>
                    <div class="col-xs-2">
                        {{--<a href="{{ route('l_AssessmentQuestionOperation.show', $assessment->assessment_id) }}" class="btn btn-default btn-lg btn-block btn-flat">Back</a>--}}
                        <input type="hidden" value="{{$assessment->assessment_id}}" name="assessment_id">
                        {!! Form::submit('Remove Question(s)', array('class' => 'btn btn-block btn-success'))!!}
                        {{--onsubmit dkt form open--}}
                        {{--onclick dkt button--}}
{{--                        {!! Form::submit('Delete Question(s)', array('class' => 'btn btn-block btn-success', 'onClick' => 'return ConfirmDelete()'))!!}--}}
                    </div>
                @else
                    <label class ="col-sm-5 control-label"></label>
                    <div class="col-xs-4">
                        <a href="{{  route('l_AssessmentQuestionOperation.show', $assessment->assessment_id) }}" class="btn btn-default btn-block btn-flat">Back</a>
                    </div>
                @endif
            </div>

            {{--<h1><b>Manage Questions</b></h1><br>--}}
            @if($questionsAdded->count() > 0)
                <h1 class="box-title"><b>QUESTIONS ADDED</b></h1>
            @endif
        </div>
        <!-- /.box-header -->
        @if($questionsAdded->count() > 0)
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th><center>SELECT</center></th>
                        <th><center>NO</center></th>
                        <th>QUESTION</th>
                        <th>ANSWER</th>
                        <th>CHAPTER</th>
                        <th><span class="pull-right">OPERATIONS</span></th>
                    </tr>
                    @if($questionsAdded->count() > 0)
                        <?php $x = 1; ?>
                        @foreach($questionsAdded as $questionAdded)
                            <tr>
                                <td>
                                   <center>
                                       {{--<div class="pull-right">--}}
                                           <input class="checkbox icheck" type="checkbox" value="{{$questionAdded->assessmentquestion_id}}" name="assessmentquestion_id[]">
                                       {{--</div>--}}
                                   </center>
                                </td>
                                <td><center>{{$x}}</center></td>
                                <td>{!! isset($questionAdded)?nl2br(e($questionAdded->question->question)):"" !!}</td>
                                <td>{!! isset($questionAdded)?nl2br(e($questionAdded->question->answer)):"" !!}</td>
                                <td>{{isset($questionAdded->question->chapter)?$questionAdded->question->chapter->chapter_no." - ".$questionAdded->question->chapter->chapter_name:"No Data"}}</td>
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
        @endif
    </div>
    {!! Form::close() !!}
@stop()
