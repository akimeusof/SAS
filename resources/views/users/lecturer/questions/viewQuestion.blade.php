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
            {!! Form::open(array('class' => 'form-horizontal')) !!}
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Subject:</label>
                <div class="col-xs-4">
                    <label class="control-label">
                    {{$question->subject->code." - ".$question->subject->name}}</label>
{{--                            {!! Form::text('subject',$subjectSelected->code." - ".$subjectSelected->name, array('class' => 'form-control', 'disabled' => 'disabled')) !!}--}}
                    {{--                    {!! Form::text('chapter', null, array('class' => 'form-control', 'placeholder' => '1')) !!}--}}

                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Chapter:</label>
                <div class="col-xs-4">
                    <label class="control-label">
                        {{isset($question->chapter)?$question->chapter->chapter_no." - ".$question->chapter->chapter_name:"No Data"}}
                    </label>
                </div>
            </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">Diagram:</label>
                    <div class="col-xs-4">
                        <label class="control-label">
                            @if($question->diagram != null)
                                {{--<a href="">--}}
                                    <img src="/uploads/question_diagram/{{$question->diagram}}" class="center-block user-image" title=" " style="width:400px; height:400px">
                                {{--</a>--}}
                            @else
                                None
                            @endif

                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">Question:</label>
                    <div class="col-xs-4">
                        <label class="">
                            {!! nl2br(e($question->question)) !!}
                          </label>
                    </div>
                </div>

                <div class ="form-group">
                    <label class ="col-sm-4 control-label">Answer:</label>
                    <div class="col-xs-4">
                        <label>
                            {!! nl2br(e($question->answer)) !!}
                        </label>
                    </div>
                </div>

                <div class ="form-group">
                    <label class ="col-sm-4 control-label">Access Type:</label>
                    <div class="col-xs-4">
                       <label class="control-label">
                            @if($question->use_type == 0)
                                Private
                            @else
                                Public
                           @endif
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label"></label>
                    @if($question->user_id == $user->id)
                        <div class="col-xs-2">
{{--                                <a class="btn btn-default btn-lg btn-block btn-flat" href="{{route('lecturerViewAllQuestions')}}">Back</a>--}}
{{--                                <a class="btn btn-default btn-lg btn-block btn-flat" href="{{ route('lecturerViewAllQuestions') }}">Back</a>--}}
                            <a class="btn btn-default btn-lg btn-block btn-flat" href="{{ URL::previous() }}">Back</a>
                            {{--<a href="{{ route('lecturerQuestionOperation.edit', $subject->subject_id) }}" class="btn btn-success">Edit Subject</a>--}}

                        </div>
                        <div class="col-xs-2">
                            <a href="{{ route('lecturerQuestionOperation.edit', $question->question_id) }}" class="btn btn-lg btn-primary btn-flat btn-block">Edit Question Details</a>
                        </div>
                    @else
                        <div class="col-xs-4">
                            <a class="btn btn-default btn-lg btn-block btn-flat" href="{{ URL::previous() }}">Back</a>
                        </div>
                    @endif
                </div>
                {!! Form::close() !!}
        </div>
    </div>
        <!-- /.box -->
@stop()
