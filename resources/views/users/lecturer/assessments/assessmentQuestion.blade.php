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
{!!
   Form::open(array('class' => 'form-horizontal',
         'route' => 'l_AssessmentQuestionOperation.store'))
!!}
    <div class="box">
        <div class="box-header">
            {!! Form::open(array('class' => 'form-horizontal')) !!}
            <h1><b>Choose Questions</b></h1><br>
            <h1 class="box-title">
                Assessment: <b>{{strtoupper($assessment->assessmentname)}}</b><br><br>

                Subject: <b>{{$assessment->classroom->subject->name}}</b><br><br>

                Section: <b>{{strtoupper($assessment->classroom->section)}}</b><br><br>

                Question(s) Selected: <b>{{isset($questionsAdded)?$questionsAdded->count():"0"}}</b>/<b>{{$assessment->numberofquestion}}</b><br><br>

                if current = max

{{--                <input type="hidden" name="assessment_id" value="{{$assessment->assessment_id}}">--}}
{{--                {!! Form::submit('Proceed', array('class' => 'btn btn-block btn-primary btn-lg pull-right'))!!}--}}
                else
                button disabled
                {{$assessment->assessment_id}}
            </h1>
            <div class ="form-group">
                <div class="col-xs-3">
                    <a href="{{ route('l_AssessmentQuestionOperation.show', $assessment->assessment_id) }}" class="btn btn-warning btn-lg btn-block btn-flat">Remove Questions</a>
                </div>
                <div class="col-xs-3">
                    {!! Form::submit('Add Questions', array('class' => 'btn btn-block btn-primary btn-lg pull-right'))!!}
                </div>
            </div>
            <br><br>
            <h1 class="box-title"><b>QUESTIONS ADDED</b></h1>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>NO</th>
                    <th>QUESTION</th>
                    <th>ANSWER</th>
                    <th>CHAPTER</th>
                    <th><span class="pull-right">SELECTED: 0(kosong current checked checkbox)</span></th>

                </tr>
                @if($questionsAdded->count() > 0)
                    <?php $x = 1; ?>
                    @foreach($questionsAdded as $questionAdded)
                        <tr>
                            <td>{{$x}}</td>
                            <td>{{isset($questionAdded)?$questionAdded->question:""}}</td>
                            <td>{{isset($questionAdded)?$questionAdded->answer:""}}</td>
                            <td>{{isset($questionAdded)?$questionAdded->chapter:""}}</td>
                            <td>
                                <div class="checkbox icheck pull-right">
                                    <label>
                                        <input type="checkbox" value="{{$questionAdded->question_id}}" name="question_id[]" checked>
                                    </label>
                                </div>
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


        <div class="box">
            <div class="box-header">
                <h1 class="box-title">
                  <b>QUESTIONS AVAILABLE</b>
                </h1>

                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 300px;">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>NO</th>
                        <th>QUESTION</th>
                        <th>ANSWER</th>
                        <th>CHAPTER</th>
                        <th><span class="pull-right">SELECTED: 0(kosong current checked checkbox)</span></th>
                    </tr>
                    @if($questions->count() > 0)
                        <?php $x = 1; ?>
    {{--                    @foreach($questionsAdded as $questionAdded)--}}
                            @foreach($questions as $question)
    {{--                            @if($question->question_id != $questionAdded->question_id)--}}
                                <tr>
                                    <td>{{$x}}</td>
                                    <td>{{$question->question}}</td>
                                    <td>{{$question->answer}}</td>
                                    <td>{{$question->chapter}}</td>
                                    <td>
                                        <div class="checkbox icheck pull-right">
                                            <label>
                                                <input type="checkbox" value="{{$question->question_id}}" name="question_id[]">
                                            </label>
                                        </div>
                                    </td>

                                </tr>
                                <?php $x++; ?>
                                {{--@endif--}}
                            @endforeach
                        {{--@endforeach--}}
                        @if($questions->count() > 10)
                        <tr>
                        <th>NO</th>
                        <th>QUESTION</th>
                        <th>ANSWER</th>
                        <th>CHAPTER</th>
                        <th><span class="pull-right">SELECT</span></th>
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
        {!! Form::close() !!}
        </div>
@stop()
