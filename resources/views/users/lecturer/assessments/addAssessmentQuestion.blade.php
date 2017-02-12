@extends('layout.layoutSubLecturer')
@section('content')
</section>

<!-- Main content -->
<script>
    function checkboxes($max)
    {
        var inputElems = document.getElementsByTagName("input"),
                count = 0;

        for (var i=0; i<inputElems.length; i++) {
            if (inputElems[i].type == "checkbox" && inputElems[i].checked == true){
                count++;
            }
        }
        if(count > $max){
            alert("You have exceeded this assessment question limit. Question(s) Selected: "+count+" / "+$max);
            return false;
        }
        else{
            alert("Question(s) Selected: " + count + " / " + $max);
            return true;
        }
    }
</script>
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
    {!!
       Form::open(array('class' => 'form-horizontal',
             'route' => 'l_AssessmentQuestionOperation.store',
             'onSubmit' => 'return checkboxes('.$assessment->numberofquestion.')'))
    !!}
    <div class="box">
        <div class="box-header">
            <center>
                <h3><b>Add Questions</b></h3>
            </center>
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
                <label class ="col-sm-5 control-label">Questions Selected:</label>
                <div class="col-xs-4">
                    <label class ="control-label">
                        {{isset($questionsAdded)?$questionsAdded->count()." / ".$assessment->numberofquestion:"0 / ".$assessment->numberofquestion}}
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-5 control-label"></label>
                <div class="col-xs-2">
                    <a href="{{ route('l_AssessmentQuestionOperation.show', $assessment->assessment_id) }}" class="btn btn-default btn-block btn-flat">Cancel</a>
                </div>
                <div class="col-xs-2">
                    {{--<a href="{{ route('l_AssessmentQuestionOperation.show', $assessment->assessment_id) }}" class="btn btn-default btn-lg btn-block btn-flat">Back</a>--}}
                    <input type="hidden" value="{{$assessment->assessment_id}}" name="assessment_id">
                        {!! Form::submit('Add Questions', array('class' => 'btn btn-block btn-success pull-right'))!!}
                </div>
            </div>
        </div>
        <!-- /.box-header -->
        @if($questionsAdded->count() > 0)
            <div class="box-header">
                <h1 class="box-title">
                    <b>Questions Added</b>
                </h1>
            </div>
        @endif
        @if($questionsAdded->count() > 0)
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th><center></center></th>
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
                                   <input class="checkbox icheck" type="checkbox" value="" name="" checked disabled>
                               </center>
                           </td>
                            <td>{{$x}}</td>
                            <td>{!! isset($questionAdded)?nl2br(e($questionAdded->question->question)):"" !!}</td>
                            {{--{!! nl2br(e($question->question)) !!}--}}
                            <td>{!! isset($questionAdded)?nl2br(e($questionAdded->question->answer)):"" !!}</td>
                            <td>
                                {!! isset($questionAdded->question->chapter)?$questionAdded->question->chapter->chapter_no." - ".$questionAdded->question->chapter->chapter_name:"" !!}

{{--                            {{dd($questionAdded->question->chapter)}}</td>--}}
                            <td>
                                <span class="pull-right">
                                    <a href="{{ route('lecturerQuestionOperation.show', $assessment->assessment_id) }}" class="btn btn-info btn-flat">View Question Details</a>
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

    <div class="box">
        <div class="box-header">
            <h1 class="box-title">
                <b>Questions Available (Personal)</b>
            </h1>
        </div>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th><center></center></th>
                    <th><center>NO</center></th>
                    <th>QUESTION</th>
                    <th>ANSWER</th>
                    <th>CHAPTER</th>
                    <th><span class="pull-right">OPERATIONS</span></th>
                </tr>
                @if($privateQuestions->count() > 0)
                    <?php $x = 1; ?>
                    {{--                    @foreach($questionsAdded as $questionAdded)--}}
                    @foreach($privateQuestions as $privateQuestion)
                        {{--                            @if($question->question_id != $questionAdded->question_id)--}}
                        <tr>
                            <td>
                                <center>
                                    <input class="checkbox icheck" type="checkbox" value="{{$privateQuestion->question_id}}" name="question_id[]">
                                </center>
                            </td>
                            <td><center>{{$x}}</center></td>
                            <td>{!! nl2br(e($privateQuestion->question)) !!}</td>
                            <td>{!! nl2br(e($privateQuestion->answer)) !!}</td>
                            <td>
                                {!! isset($privateQuestion->chapter)?$privateQuestion->chapter->chapter_no." - ".$privateQuestion->chapter->chapter_name:"" !!}
                            </td>
                            <td>
                            <span class="pull-right">
                                <a href="{{ route('lecturerQuestionOperation.show', $privateQuestion->question_id) }}" class="btn btn-info btn-flat">View Question Details</a>
                            </span>
                            </td>
                        </tr>
                        <?php $x++; ?>
                        {{--@endif--}}
                    @endforeach
                    {{--@endforeach--}}
                    @if($questions->count() > 10)
                        <tr>
                            <th><center></center></th>
                            <th><center>NO</center></th>
                            <th>QUESTION</th>
                            <th>ANSWER</th>
                            <th>CHAPTER</th>
                            <th><span class="pull-right">OPERATIONS</span></th>
                        </tr>
                    @endif
                @else
                    <tr>
                        <td colspan="5">No more questions available for this subject.</td>
                    </tr>
                @endif

            </table>
        </div>
    </div>

    <div class="box">
        <div class="box-header">
            <h1 class="box-title">
                <b>Questions Available (Others)</b>
            </h1>
        </div>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th><center></center></th>
                    <th><center>NO</center></th>
                    <th>QUESTION</th>
                    <th>ANSWER</th>
                    <th>CHAPTER</th>
                    <th><span class="pull-right">OPERATIONS</span></th>
                </tr>
                @if($questions->count() > 0)
                    <?php $x = 1; ?>
                    @foreach($questions as $question)
                        <tr>
                            <td>
                                <center>
                                    <input class="checkbox icheck" type="checkbox" value="{{$question->question_id}}" name="question_id[]">
                                </center>
                            </td>
                            <td><center>{{$x}}</center></td>
                            <td>{!! nl2br(e($question->question)) !!}</td>
                            <td>{!! nl2br(e($question->answer)) !!}</td>
                            <td>
                                {!! isset($question->chapter)?$question->chapter->chapter_no." - ".$question->chapter->chapter_name:"" !!}
                            </td>
                            <td>
                                <span class="pull-right">
                                    <a href="{{ route('lecturerQuestionOperation.show', $question->question_id) }}" class="btn btn-info btn-flat">View Question Details</a>
                                </span>
                            </td>
                        </tr>
                        <?php $x++; ?>
                        {{--@endif--}}
                    @endforeach
                    {{--@endforeach--}}
                    @if($questions->count() > 10)
                        <tr>
                            <th><center></center></th>
                            <th><center>NO</center></th>
                            <th>QUESTION</th>
                            <th>ANSWER</th>
                            <th>CHAPTER</th>
                            <th><span class="pull-right">OPERATIONS</span></th>
                        </tr>
                    @endif
                @else
                    <tr>
                        <td colspan="5">No more questions available for this subject.</td>
                    </tr>
                @endif

            </table>
        </div>
    </div>
@stop()
