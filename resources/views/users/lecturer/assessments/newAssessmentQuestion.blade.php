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
        {!!
           Form::open(array('class' => 'form-horizontal',
                                     'route' => 'lecturerAssessmentQuestionOperation.store'))
        !!}
        <div class="box-header">
            <h1 class="box-title">
                {{--<div class="col-xs-12">--}}
                    <b>Choose Question</b><br>
                {{--</div>--}}
                {{--<div class="col-xs-12">--}}
                    Assessment: <b>{{strtoupper($assessment->name)}}</b><br>
                {{--</div>--}}
                {{--<div class="col-xs-12">--}}
                    Subject: <b>{{$assessment->classroom->subject->name}}</b><br>
                {{--</div>--}}
                {{--<div class="col-xs-12">--}}
                    Section: <b>{{strtoupper($assessment->classroom->section)}}</b><br>
                {{--</div>--}}
                {{--<div class="col-xs-12">--}}
                    Question(s) Selected: <b>current</b>/<b>max masa create</b><br>
                {{--</div>--}}
                {{--<div class="col-xs-12">--}}
                if current = max
                    <input type="hidden" name="assessment_id" value="{{$assessment->assessment_id}}">
                    {!! Form::submit('Proceed', array('class' => 'btn btn-block btn-success btn-lg'))!!}
                else
                button disabled
                {{$assessment->assessment_id}}

                {{--</div>--}}
{{--                    {!! Form::submit('Update', array('class' => 'btn btn-block btn-success btn-lg')) !!}--}}

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
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>NO</th>
                    <th>QUESTION</th>
                    <th>ANSWER</th>
                    <th>CHAPTER</th>
                    <th><span class="pull-right">SELECT: 0(kosong current checked checkbox)</span></th>
                </tr>
                @if($questions->count() > 0)
                    <?php $x = 1; ?>
                    @foreach($questions as $question)
                        <tr>
                            <td>{{$x}}</td>
                            <td>{{isset($question)?$question->question:""}}</td>
                            <td>{{isset($question)?$question->answer:""}}</td>
                            <td>{{isset($question)?$question->chapter:""}}</td>
                            <td>
                                <div class="checkbox icheck pull-right">
                                    <label>
                                        <input type="checkbox" value="{{$question->question_id}}" name="question_id[]">
                                    </label>
                                </div>
                            </td>

                        </tr>
                        <?php $x++; ?>
                    @endforeach
                    <tr>
                        <th>NO</th>
                        <th>QUESTION</th>
                        <th>ANSWER</th>
                        <th>CHAPTER</th>
                        <th><span class="pull-right">SELECT</span></th>
                    </tr>
                @else
                    <tr>
                        <td colspan="5">No questions for the subject found.</td>
                    </tr>
                    <tr>
                        <td colspan="5">Add new questions?</td>
                    </tr>
                @endif

            </table>
        </div>
        {{--box-body--}}
        {{--<div class="box-footer"></div>--}}
    </div>
@stop()
