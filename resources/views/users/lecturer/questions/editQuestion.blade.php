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
            <center><h3><b>Question Uploaded</b> by <b><u>{{$question->user->lecturerprofile->name}}</u></b></h3></center>
        </div>
        <div class="box-body">
            {!! Form::model($question, array(
                            'class' => 'form-horizontal',
                            'route' => ['lecturerQuestionOperation.update', $question->question_id],
                            'method' => 'patch')) !!}
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Subject:</label>
                <div class="col-xs-4">
                    <label class="control-label">
                        {{isset($question->subject)?$question->subject->code." - ".$question->subject->name:"No Data"}}
                    </label>
                    {{--                            {!! Form::text('subject',$subjectSelected->code." - ".$subjectSelected->name, array('class' => 'form-control', 'disabled' => 'disabled')) !!}--}}
                    {{--                    {!! Form::text('chapter', null, array('class' => 'form-control', 'placeholder' => '1')) !!}--}}

                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Chapter:</label>
                <div class="col-xs-4">
                    {{--<label class="control-label"><h4><b>--}}
                    <select name="chapter" class="form-control">
                        <option value="{{$question->chapter_no}}" selected>{{$question->chapter->chapter_no." - ".$question->chapter->chapter_name}}</option>
                        @foreach($chapters as $chapter)
                            @if($chapter->chapter_no != $question->chapter_no)
                                <option value="{{$chapter->chapter_no}}">{{$chapter->chapter_no." - ".$chapter->chapter_name}}</option>
                            @endif
                        @endforeach
                    </select>
                    {{--                            {{isset($question->chapter)?$question->chapter->chapter_no." - ".$question->chapter->chapter_name:"No Data"}}--}}
                    {{--</b></h4></label>--}}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Question:</label>
                <div class="col-xs-4">
                    {{--<label class="control-label"><h4><b>--}}
                                {!! Form::textarea('question', isset($question->question)?$question->question:"No Data", array('class' => 'form-control')) !!}
                            {{--</b></h4></label>--}}
                </div>
            </div>

            <div class ="form-group">
                <label class ="col-sm-4 control-label">Answer:</label>
                <div class="col-xs-4">
                    {{--<label class="control-label"><h4><b>--}}
                                {!! Form::textarea('answer', isset($question->answer)?$question->answer:"No Data", array('class' => 'form-control')) !!}
                            {{--</b></h4></label>--}}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Access Type:</label>
                <div class="col-xs-4">
                    {{--<label class="control-label"><h4><b>--}}
                        <select name="access_type" class="form-control">
                            @if($question->use_type == 0)
                                <option value="0" selected>Private</option>
                                <option value="1">Public</option>
                            @else
                                <option value="1" selected>Public</option>
                                <option value="0">Private</option>
                            @endif
                        </select>
                    {{--</b></h4></label>--}}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"></label>
                <div class="col-xs-2">
                    <a class="btn btn-default btn-lg btn-block btn-flat" href="{{ URL::previous() }}">Cancel</a>

                </div>
                <div class="col-xs-2">
                    {!! Form::submit('Update Details', array('class' => 'btn btn-lg btn-success btn-flat btn-block')) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
        <!-- /.box -->
@stop()
