@extends('layout.layoutSubAdmin')
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
            {{--<h3 class="box-title">--}}
                <h3 class="box-title">List of <b>Available Questions</b></h3>
            {{--</h3>--}}
            {!! Form::open(array(
                   'class' => 'form-horizontal',
                   'route' => 'viewAllQuestionsFiltered')) !!}
            <br>
            <div class="col-xs-1">
                <label class ="col-sm-1 control-label">
                    <h4 class="box-title"><b>Filter:</b></h4>
                </label>
            </div>
            <div class="col-xs-3">
                <select name="subject_id" class="form-control">
                    @if($s_selected == 0)
                        <option value="" disabled selected>Select Subject CODE-NAME to Filter</option>
                        {{--<option value="0">All</option>--}}
                        @foreach($subjects as $subject)
                            <option value="{{$subject->subject_id}}">{{$subject->code." - ".$subject->name}}</option>
                        @endforeach
                    @else
                        <option value="0">View All</option>
                        <option value="{{$subjectSelected->subject_id}}" selected>{{$subjectSelected->code." - ".$subjectSelected->name}}</option>
                        @foreach($subjects as $subject)
                            @if($subject->subject_id != $subjectSelected->subject_id)
                                <option value="{{$subject->subject_id}}">{{$subject->code." - ".$subject->name}}</option>
                            @endif
                        @endforeach
                    @endif


                </select>
            </div>
            @if($s_selected !=0)
                <div class="col-xs-1">
                    <select name="chapter" class="form-control">
                        <option value="0" disabled selected>Chapter</option>
                        @for($i = 1; $i <= $subjectSelected->totalchapter; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
            @endif
            <div class="col-xs-1">
                {!! Form::submit('Submit', array('class' => 'btn btn-primary btn-block btn-flat')) !!}
            </div>
            {!! Form::close() !!}

            {{--<div class="box-tools">--}}
            {{--<br>--}}
            {{--<div class="input-group input-group-sm" style="width: 300px;">--}}
            {{--<input type="text" name="table_search" class="form-control pull-right" placeholder="Search">--}}

            {{--<div class="input-group-btn">--}}
            {{--<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
        </div>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th width="2%"><center>NO</center></th>
                    <th width="15%">SUBJECT</th>
                    <th width="10%"><center>CHAPTER</center></th>
                    <th width="">QUESTION</th>
                    <th width="">ANSWER</th>
                    <th><center>OPERATION</center></th>
                </tr>
                </thead>
                <tbody>
                @if($questions->count() == 0)
                    <tr>
                        <td colspan="3">No question added to date.</td>

                    </tr>
                @else
                    <?php $x = 1; ?>
                    @foreach($questions as $question)
                        <tr>
                            <td><center>{{$x}}</center></td>
                            <td>{{isset($question->subject)?$question->subject->code." - ".$question->subject->name:"No Data"}}</td>
                            <td><center>{{isset($question)?$question->chapter->chapter_no." - ".$question->chapter->chapter_name:"No Data"}}</center></td>
                            <td>{!! isset($question)?nl2br(e($question->question)):"No Data" !!}</td>
                            <td>{!! isset($question)?nl2br(e($question->answer)):"No Data" !!}</td>
                            <td>
                            <center>
                                <a href="{{ route('lecturerQuestionOperation.show', $question->question_id) }}" class="btn btn-block btn-primary">View Details</a>
                                @if($question->user_id == \Auth::user()->id)
                                    <a href="{{ route('lecturerQuestionOperation.edit', $question->question_id) }}" class="btn btn-block btn-primary">Edit Details</a>
                                    <a href="{{ route('lecturerQuestionOperation.edit', $question->question_id) }}" class="btn btn-block btn-primary">Delete Question</a>
                                @endif
                            </center>
                            </td>
                        </tr>
                        <?php $x++; ?>
                    @endforeach

                @endif
                </tbody>
            </table>

        </div>
        {{--box-body--}}

        <div class="box-footer">

        </div>
        {{--box-footer--}}
    </div>
        <!-- /.box -->
@stop()
