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
                                'route' => 'lecturerHandleAddQuestion',
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
               'route' => 'lecturerAddQuestionSelected')) !!}
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
                        <a class="btn btn-default btn-block btn-flat" href="{{ route('lecturerAddQuestion') }}">Cancel</a>
                        {{--<a href="{{ route('lecturerQuestionOperation.edit', $subject->subject_id) }}" class="btn btn-success">Edit Subject</a>--}}

                    </div>
                    <div class="col-xs-2">
                        {{--to hold the value of user_id and subject_id and change status to 1--}}
                        <input type="hidden" name="user_id" value="{{\Auth::user()->id}}">
                        {{--<input type="hidden" name="status" value="1">--}}
                        {!! Form::submit('Proceed to Add Question', array('class' => 'btn btn-success btn-block btn-flat')) !!}
                    </div>
                </div>
                {!! Form::close() !!}

            @endif
        </div>
        {{--not yet select subj to add question--}}

    </div>
    <!-- /.box -->
@stop()
