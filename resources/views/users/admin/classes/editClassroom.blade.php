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
    {!! Form::model($classToEdit, array(
                          'method' => 'patch',
                          'class' => 'form-horizontal',
                          'route' => ['classroomOperation.update', $classToEdit->classroom_id]

                      )) !!}
<!-- Default box -->
    <div class="box">
        <div class="box-header">
            <center><h3>Edit <b>Class</b></h3></center>
        </div>
        <div class="box-body">
            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Lecturer:</label>
                <div class="col-xs-4">
                    <select class="form-control" name="lecturer">
                        <option value="{{isset($classToEdit->user)?$classToEdit->user->id:""}}"selected>{{isset($classToEdit->user->lecturerprofile)?$classToEdit->user->lecturerprofile->name:""}}</option>
                        @foreach($lecturers as $lecturer)
                            <option value="{{$lecturer->id}}">{{isset($lecturer->lecturerprofile)?$lecturer->lecturerprofile->id." - ".$lecturer->lecturerprofile->name:""}}</option>
                        @endforeach
                    </select>
                    {{--                    {!! Form::select('lecturer', $lecturers, null, array('class' => 'form-control', 'placeholder' => 'Select Lecturer')) !!}--}}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Subject:</label>
                <div class="col-xs-4">
                    <select class="form-control" name="lecturer">
                        <option value="{{$classToEdit->subject_id}}" selected>{{isset($classToEdit->subject)?$classToEdit->subject->code." - ".$classToEdit->subject->name:""}}</option>
                        @foreach($subjects as $subject)
                            <option value="{{$subject->subject_id}}">{{$subject->code." - ".$subject->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Section:</label>
                <div class="col-xs-4">
                    {!! Form::text('section', $classToEdit->section, array('class' => 'form-control', 'placeholder' => '02A/2A')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Capacity:</label>
                <div class="col-xs-4">
                    <select name="capacity" class="form-control">
                        <option value="{{$classToEdit->capacity}}" selected>{{$classToEdit->capacity}}</option>
                        @for ($i = 1; $i <= 200; $i++)
                            @if($i != $classToEdit->capacity)
                                <option value="{{$i}}">{{$i}}</option>
                            @endif
                        @endfor
                    </select>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"></label>
                <div class="col-xs-2">
                    <a class="btn btn-default btn-block btn-flat" href="{{ route('viewAllClassroom') }}">Cancel</a>
                </div>
                <div class="col-xs-2">
                    {!! Form::submit('Submit', array('class' => 'btn btn-primary btn-block btn-flat')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Enrollment Key:</label>
                <div class="col-xs-4">
                    <a href="{{route('resetEnrollmentKey', $classToEdit->classroom_id)}}" class="btn btn-flat btn-block btn-success">Reset Enrollment Key</a>
                </div>
            </div>

        </div>
        {!! Form::close() !!}
    </div>
    <!-- /.box-body -->

    <!-- /.box -->
@stop()
