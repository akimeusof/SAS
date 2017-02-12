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

{!!
    Form::open(array('class' => 'form-horizontal',
                      'route' => 'lecturerClassroomOperation.store'
              ))
!!}
<!-- Default box -->
    <div class="box">
        <div class="box-header">
            <center><h3><b>Create</b> New <b>Class</b></h3></center>
        </div>
        <div class="box-body">
            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Semester:</label>
                <div class="col-xs-4">
{{--                    {!! Form::hidden('semester_id', $currentSemester->pluck('semester_id') !!}--}}
                    {!! Form::text('semester', $currentSemester, array('class' => 'form-control', 'readonly')) !!}
                    <input type="hidden" value="{{$currentSemester_id}}" name="semester_id">

                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Subject:</label>
                <div class="col-xs-4">
                    {!! Form::select('subject', $subjects, null, array('class' => 'form-control', 'placeholder' => 'Choose Subject')) !!}
                </div>
            </div>

            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Section:</label>
                <div class="col-xs-4">
                    {!! Form::text('section', null, array('class' => 'form-control', 'placeholder' => '1/2 || 1A/1B/2A/2B')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Maximum Capacity:</label>
                <div class="col-xs-4">
                    <select name="capacity" class="form-control">
                        <option value="" disabled selected>Select Maximum Capacity</option>
                        @for ($i = 10; $i <= 200; $i+=5)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor

                    </select>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Enrollment Key:</label>
                <div class="col-xs-4">
                    {!! Form::password('enrollmentkey', array('class' => 'form-control', 'placeholder' => '**********')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"></label>
                <div class="col-xs-2">
                    <a class="btn btn-default btn-block btn-flat" href="{{ url('l_classes') }}">Cancel</a>
                </div>
                <div class="col-xs-2">
                    {!! Form::submit('Create New', array('class' => 'btn btn-primary btn-block btn-flat')) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        {{--box-body--}}
    </div>
        <!-- /.box -->
@stop()
