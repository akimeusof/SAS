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
            <center><h3><b>Insert</b> New <b>Question</b></h3></center>
        </div>
        <div class="box-body">
            @if($selected == 1)
                {!! Form::open(array('class' => 'form-horizontal',
                                'route' => 'lecturerQuestionOperation.store',
                                'enctype' => 'multipart/form-data')) !!}
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">Subject:</label>
                    <div class="col-xs-4">
                        {!! Form::text('subject', $subjectSelected->code." - ".$subjectSelected->name, array('class' => 'form-control', 'readonly')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">Diagram (Leave If None)</label>
                    <div class="col-xs-4">
                        {!! Form::file('diagram', array('class' => 'form-control', 'center-block')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">*Question:</label>
                    <div class="col-xs-4">
                        {!! Form::textarea('question', null, array('class' => 'form-control', 'row' => '5', 'placeholder' => 'Write the questions here..')) !!}
                    </div>
                </div>

                <div class ="form-group">
                    <label class ="col-sm-4 control-label">*Answer:</label>
                    <div class="col-xs-4">
                        {!! Form::textarea('answer', null, array('class' => 'form-control', 'placeholder' => 'Expected Answer', 'row' => '5')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">*Chapter:</label>
                    <div class="col-xs-4">
                        <select class="form-control" name="chapter_no">
                            <option value="" name="chapter_no" selected disabled>Select Chapter</option>
                            @foreach($chapters as $chapter)
                                <option value="{{$chapter->chapter_no}}">{{$chapter->chapter_no." - ".$chapter->chapter_name}}</option>
                            @endforeach
                            {{--@for($i = 1; $i<=$subjectSelected->totalchapter; $i++)--}}
                            {{--<option value="{{$i}}">{{$i." - ".$s}}</option>--}}
                            {{--@endfor--}}
                        </select>
                        {{--                    {!! Form::text('chapter', null, array('class' => 'form-control', 'placeholder' => '1')) !!}--}}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">
                        Question Access Setting:
                    </label>
                    <div class="col-xs-4 checkbox icheck">
                        <label>
                            <input type="radio" value="0" name="access_setting">&nbsp;Private(Only you can use this question)
                        </label><br>
                        <label>
                            <input type="radio" value="1" name="access_setting">&nbsp;Public(All lecturer can use this question)
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label"></label>
                    <div class="col-xs-2">
                        <a class="btn btn-default btn-block btn-flat" href="{{ route('lecturerQuestionOperation.create') }}">Back (Change Subject)</a>
                        {{--<a href="{{ route('lecturerQuestionOperation.edit', $subject->subject_id) }}" class="btn btn-success">Edit Subject</a>--}}

                    </div>
                    <div class="col-xs-2">
                        <input type="hidden" name="subject_id" value="{{$subjectSelected->subject_id}}">
                        <input type="hidden" name="user_id" value="{{\Auth::user()->id}}">
                        <input type="hidden" name="status" value="1">
                        {{--<input id="submit" type="submit" name="submit" value="Insert" class="btn btn-success btn-block btn-flat">--}}
                        {!! Form::submit('Insert Question', array('class' => 'btn btn-success btn-block btn-flat')) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            @else
                {!! Form::open(array(
               'class' => 'form-horizontal',
               'route' => 'lecturerNewQuestionSubjectSelected')) !!}
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">Subject:</label>
                    <div class="col-xs-4">
                        <select name="subject_id" id="subject_id" class="form-control">
                            <option value="0" selected disabled>Select Subject to Add Question</option>
                            @foreach($subjects as $subject)
                                <option value="{{$subject->subject_id}}">{{$subject->code." - ".$subject->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label"></label>
                    <div class="col-xs-2">
                        <a class="btn btn-default btn-block btn-flat" href="{{ route('lecturerQuestionOperation.create') }}">Cancel</a>
                        {{--<a href="{{ route('lecturerQuestionOperation.edit', $subject->subject_id) }}" class="btn btn-success">Edit Subject</a>--}}

                    </div>
                    <div class="col-xs-2">
                        {{--to hold the value of user_id and subject_id and change status to 1--}}
                        <input type="hidden" name="user_id" value="{{\Auth::user()->id}}">
                        <input type="hidden" name="status" value="1">
                        {!! Form::submit('Proceed to Add Question', array('class' => 'btn btn-success btn-block btn-flat')) !!}
                    </div>
                </div>
                {!! Form::close() !!}

            @endif
        </div>
        {{--not yet select subj to add question--}}
        @if($selected != 1)
            <div class="box-header">
                {!! Form::open(array(
                       'class' => 'form-horizontal',
                       'route' => 'lecturerNewQuestionFiltered')) !!}
                <h3 class="box-title"><b>List</b> of <b>Questions Added</b> by: <b>{{$user->lecturerProfile->name}}</b></h3>
                <br><br>
                <div class="col-xs-1">
                    <label class ="col-sm-1 control-label">
                        <h4 class="box-title"><b>Filter:</b></h4>
                    </label>
                    {{--<h4 class="box-title"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Filter:</b></h4>--}}
                </div>
                <div class="col-xs-3">
                    <select name="subjectFilter" class="form-control">
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
                    <div class="col-xs-1">
                        <select name="chapter" class="form-control">
                            <option value="0" disabled selected>Chapter</option>
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
                        <th width="5%"><center>ACCESS</center></th>
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
                                    @if($question->use_type == 0)
                                        Private
                                    @elseif($question->use_type == 1)
                                        Public
                                    @else
                                        Unknown
                                    @endif
                                </td>
                                <td>
                                <span class="pull-right">
                                <div class="btn-group-vertical">
                                    <a href="{{route('lecturerQuestionOperation.show', $question->question_id)}}" class="btn btn-info btn-block btn-flat">View Question</a>
                                    {{--<a href="{{route('lecturerQuestionOperation.edit', $question->question_id)}}">View Question</a>--}}
                                </div>
                                <div class="btn-group-vertical">
                                    <a href="{{route('lecturerQuestionOperation.edit', $question->question_id)}}" class="btn btn-success btn-block btn-flat">Edit Details</a>
                                </div>
                                <div class="btn-group-vertical">
                                    <script>
                                            function ConfirmDelete()
                                            {
                                                var x = confirm("Are you sure you want to delete this question? You cannot undo this process once you have confirmed.");
                                                if (x) {
                                                    return true;
                                                }
                                                else {
                                                    return false;
                                                }
                                            }
                                        </script>
                                    <a href="{{route('l_deleteQuestion', $question->question_id)}}" onClick="return ConfirmDelete()" class="btn btn-warning btn-block btn-flat">Delete Question</a>
                                </div>
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
        @endif
    </div>
    <!-- /.box -->
@stop()
