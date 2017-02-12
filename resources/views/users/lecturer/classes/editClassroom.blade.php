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
    Form::model($classView, array(
                'class' => 'form-horizontal',
                'route' => ['lecturerClassroomOperation.update', $classView->classroom_id],
                'method' => 'patch'
              ))
!!}
<!-- Default box -->
    <div class="box">
        <div class="box-header">
            <center><h3>Edit Class: <b>{{isset($classView->subject)?$classView->subject->code." - ".$classView->subject->name." Section ".$classView->section:"No Data"}}</b></h3></center>
        </div>
        <div class="box-body">
            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Subject:</label>
                <div class="col-xs-4">
                    <select name="subject_id" class="form-control">
                        <option value="" selected disabled>Select Subject ( Leave if no changes)</option>
{{--                        <option value="{{$classView->subject_id}}">{{isset($classView->subject)?$classView->subject->code." - ".$classView->subject->name:"No Data"}}</option>--}}
                        @foreach($subjects as $subject)
                            @if($subject->subject_id != $classView->subject_id)
                                <option value="{{$subject->subject_id}}">{{$subject->code." - ".$subject->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Section:</label>
                <div class="col-xs-4">
                    {!! Form::text('section', "", array('class' => 'form-control', 'placeholder' => 'Leave empty if no changes.')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Maximum Capacity:</label>
                <div class="col-xs-4">

                    <select name="capacity" class="form-control">
                    <option value="{{$classView->capacity}}" selected>{{$classView->capacity}}</option>
                    @for ($i = 10; $i <= 200; $i+=5)
                        @if($i != $classView->capacity)
                            <option value="{{$i}}">{{$i}}</option>
                        @endif
                    @endfor

                    </select>
                </div>
            </div>
            {{--<div class ="form-group">--}}
                {{--<label class ="col-sm-4 control-label">* Enrollment Key:</label>--}}
                {{--<div class="col-xs-4">--}}
                    {{--{!! Form::text('enrollmentkey', "", array('class' => 'form-control', 'placeholder' => 'Leave Empty If No Changes')) !!}--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class ="form-group">
                <label class ="col-sm-4 control-label"></label>
                <div class="col-xs-2">
                    <a class="btn btn-default btn-block btn-flat" href="{{ URL::previous() }}">Cancel</a>
                </div>
                <div class="col-xs-2">
                    {!! Form::submit('Update Details', array('class' => 'btn btn-success btn-block btn-flat')) !!}
                    {{--<a class="btn btn-primary btn-block btn-flat" href="{{ url('l_classes') }}">Edit Details</a>--}}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.box-header -->
    </div>
    <!-- /.box -->
@stop()
