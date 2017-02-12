@extends('layout.layoutSubLecturer')
@section('content')
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
        function ConfirmRemoveQuestion()
        {
            var x = confirm("Are you sure you want to remove this question?");
            if (x) {
                return true;
            }
            else {
                return false;
            }
        }
    </script>


</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
            <div class="box-header">
                {!! Form::open(array(
                       'class' => 'form-horizontal',
                       'route' => 'lecturerViewAllQuestionsSelected')) !!}
                <h3 class="box-title"><b>List</b> of <b>Questions Added</b></h3>
                <br><br>
                <div class="col-xs-1">
                    <label class ="col-sm-1 control-label">
                        <h4 class="box-title"><b>Filter:</b></h4>
                    </label>
                    {{--<h4 class="box-title"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Filter:</b></h4>--}}
                </div>
                <div class="col-xs-3">
                    <select name="subject_id" class="form-control">
                        @if($filter == 1)
                            <option value="0">All</option>
                            <option value="{{$subjectSelected->subject_id}}" selected>{{$subjectSelected->code." - ".$subjectSelected->name}}</option>
                            @foreach($subjects as $subject)
                                @if($subject->subject_id != $subjectSelected->subject_id)
                                    <option value="{{$subject->subject_id}}">{{$subject->code." - ".$subject->name}}</option>
                                @endif
                            @endforeach
                        @else
                            <option value="" selected disabled>Select Subject to Filter</option>
                            @foreach($subjects as $subject)
                                <option value="{{$subject->subject_id}}">{{$subject->code." - ".$subject->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                @if($filter != 0)
                    <div class="col-xs-2">
                        <select name="chapter" class="form-control">
                            {{--<option value="" disabled selected>Chapter</option>--}}
                            <option value="0" selected>Chapter: All</option>
                            @for($i = 1; $i <= $subjectSelected->totalchapter; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-xs-1">
                        {!! Form::submit('Filter', array('class' => 'btn btn-primary btn-block btn-flat')) !!}
                    </div>
                @else
                    <div class="col-xs-1">
                        {!! Form::submit('Filter', array('class' => 'btn btn-primary btn-block btn-flat')) !!}
                    </div>
                @endif

                {!! Form::close() !!}
                {{--<h1>Filter by Subjects</h1>--}}

            </div>
            <div class="box-body">
                <table id="example2" class="table table-hover">
                    <thead>
                    <tr>
                        <th width="3%"><center>NO</center></th>
                        <th width="12%">SUBJECT</th>
                        <th width="7%">CHAPTER</th>
                        <th width="21%">QUESTION</th>
                        <th width="29%">ANSWER</th>
                        <th width="23%"><span class="pull-right">OPERATION</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($questions->count() >= 1)
                        <?php $x=1;?>
                        @foreach($questions as $question)
                            <tr>
                                <td><center>{{$x}}</center></td>
                                <td>{{isset($question->subject)?$question->subject->code." - ".$question->subject->name:""}}</td>
                                <td>{{isset($question->chapter)?$question->chapter_no." - ".$question->chapter->chapter_name:"No Data"}}</td>
                                {{--                    <td>{{isset($question)?$question->question:""}}</td>--}}
                                <td>
                                    {!! nl2br(e($question->question)) !!}
                                </td>
                                <td>
                                    {{--                        {{isset($question)?$question->answer:""}}--}}
                                    {!! nl2br(e($question->answer)) !!}
                                    {{--e($x) is equivalent to {{ $x }}.--}}
                                </td>
                                <td>
                                <span class="pull-right">
                                <div class="btn-group-vertical">
                                    <a href="{{route('lecturerQuestionOperation.show', $question->question_id)}}" class="btn btn-info btn-block btn-flat">View Question</a>
                                    {{--<a href="{{route('lecturerQuestionOperation.edit', $question->question_id)}}">View Question</a>--}}
                                </div>
                                {{--<div class="btn-group-vertical">--}}
                                    {{--<a href="{{route('lecturerQuestionOperation.edit', $question->question_id)}}" class="btn btn-primary btn-block btn-flat">Edit Details</a>--}}
                                {{--</div>--}}
                                {{--<div class="btn-group-vertical">--}}
                                    {{--<a href="{{route('lecturerQuestionOperation.edit', $question->question_id)}}" class="btn btn-primary btn-block btn-flat">Delete Question</a>--}}
                                {{--</div>--}}
                                </span>
                                </td>
                            </tr>
                            <?php $x++; ?>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">
                                You have no questions uploaded for this subject.
                            </td>
                        </tr>
                    @endif


                    </tbody>
                </table>
            </div>
            {{--box-body--}}
    </div>
    <!-- /.box -->
@stop()
