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
                      'route' => 'l_handleEditClassroomEK'
              ))
    !!}
<!-- Default box -->
    <div class="box">
        <div class="box-header">
            <center><h3>View Class: <b>{{isset($classView->subject)?$classView->subject->code." - ".$classView->subject->name:"No Data"}}</b></h3></center>
        </div>
        <div class="box-body">
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Subject:</label>
                <div class="col-xs-4">
                    <label class ="control-label">
                        {{isset($classView->subject)?$classView->subject->code." - ".$classView->subject->name:"No Data"}}
                    </label>
                </div>
            </div>

            <div class ="form-group">
                <label class ="col-sm-4 control-label">Section:</label>
                <div class="col-xs-4">
                    <label class ="control-label">
                        {{$classView->section}}
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Maximum Capacity:</label>
                <div class="col-xs-4">
                    <label class ="control-label">
                        {{$classView->capacity}}
                    </label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Enter Current Enrollment Key:</label>
                <div class="col-xs-4">
                    {!! Form::password('current_enrollment_key', array('class' => 'form-control') ) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Enter New Enrollment Key:</label>
                <div class="col-xs-4">
                    {!! Form::password('new_enrollment_key', array('class' => 'form-control') ) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Re - Enter New Enrollment Key:</label>
                <div class="col-xs-4">
                    {!! Form::password('re_enter_current_enrollment_key', array('class' => 'form-control') ) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"></label>
                <div class="col-xs-2">
                    <a class="btn btn-default btn-block btn-flat" href="{{  URL::previous() }}">Cancel</a>
                </div>
                <div class="col-xs-2">
                    <input type="hidden" value="{{$classView->classroom_id}}" name="classroom_id">
                    {!! Form::submit('Update Enrollment Key', array('class' => 'btn btn-success btn-block btn-flat')) !!}
                    {{--<a class="btn btn-primary btn-block btn-flat" href="{{ route('lecturerClassroomOperation.edit', $classView->classroom_id) }}">Edit Details</a>--}}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.box-header -->
        {{--box-body--}}
    </div>
    <!-- /.box -->
@stop()
