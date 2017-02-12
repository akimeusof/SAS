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
            <center><h3><b>Create</b> New <b>Assessment</b></h3></center>
        </div>
        <div class="box-body">
            {{--@if($selected == 1)--}}
            {!!
               Form::open(array('class' => 'form-horizontal',
                 'route' => 'lecturerAssessmentOperation.store'))
            !!}
            <div class ="form-group">
                <label class ="col-sm-4 control-label">
                    Class:
                </label>
                <div class="col-xs-4">
{{--                        {!! Form::text('classroom', $classroomSelected->subject->code." - ".$classroomSelected->subject->name, array('class' => 'form-control', 'disabled' => 'disabled')) !!}--}}
{{--                        {!! Form::select('classroom_id', $classrooms->subjects()->name, null, array('class' => 'form-control', 'placeholder' => 'Select Class and Section')) !!}--}}
                <select name="classroom" class="form-control">
                    @if($classrooms->count() >= 1)
                    <option value="" disabled selected>Code - Subject - Section</option>
                    @foreach($classrooms as $classroom)
                        <option value="{{$classroom->classroom_id}}">{{$classroom->subject->code." - ".$classroom->subject->name." Section: ".$classroom->section}}</option>
                    @endforeach
                    @else
                        <option value="" selected disabled>You have no active class for this semester. Please create a new class to proceed.</option>
                    @endif
                </select>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Assessment Name:</label>
                <div class="col-xs-4">
                    {!! Form::text('assessment_name', null, array('class' => 'form-control', 'placeholder' => 'Name of Assessment: Quiz 2')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Assessment Marks (%):</label>
                <div class="col-xs-4">
                    <select class="form-control" name="assessment_marks">
                        <option value="" disabled selected>Select Total Assessment Marks</option>
                        @for ($i = 5; $i <= 100; $i++)
                            {{--@if($i <=20)--}}
                                <option value="{{$i}}">{{$i}}</option>
                            {{--@else--}}

                        @endfor
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class ="col-sm-4 control-label">Number of Question(s):</label>
                <div class="col-xs-4">
                <select class="form-control" name="number_of_question">
                    <option value="" disabled selected>Select Number of Question(s)</option>
                    @for ($i = 1; $i <= 20; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Time Limit (Minutes):</label>
                <div class="col-xs-4">
                    <select class="form-control" name="time_limit">
                        <option value="" disabled selected>Select Time Limit in Minutes</option>
                        @for ($i = 10; $i <= 120; $i+=10)
                                <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Open Date:</label>
                <div class="col-xs-4">
                    {!! Form::date('open_date', null, array('class' => 'form-control', 'placeholder' => 'Start Date of Assessment')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Open Time:</label>
                <div class="col-xs-4">
                    {!! Form::time('open_time', null, array('class' => 'form-control', 'placeholder' => 'Start Time of Assessment. EX: 17:00')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Close Date:</label>
                <div class="col-xs-4">
                    {!! Form::date('close_date', null, array('class' => 'form-control', 'placeholder' => 'End Date of Assessment')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Close Time:</label>
                <div class="col-xs-4">
                    {!! Form::time('close_time', null, array('class' => 'form-control', 'placeholder' => 'End Time of Assessment. EX: 17:00')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Remarks:</label>
                <div class="col-xs-4">
                    {!! Form::textarea('remarks', null, array('class' => 'form-control', 'placeholder' => 'Chapter Included: 4, 5, 6.', 'rows' => '3')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"></label>
                <div class="col-xs-2">
                    <a class="btn btn-default btn-block btn-flat" href="{{ route('l_viewAllAssessment') }}">List of Assessments</a>
                </div>
                <div class="col-xs-2">
                    <input type="hidden" name="status" value="1">
                    {!! Form::submit('Submit', array('class' => 'btn btn-success btn-block btn-flat')) !!}
                </div>
            </div>
        </div>
    </div>
        <!-- /.box -->
@stop()
