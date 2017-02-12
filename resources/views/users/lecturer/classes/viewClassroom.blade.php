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
                <label class ="col-sm-4 control-label">Capacity:</label>
                <div class="col-xs-4">
                    <?php
                        $current = App\Enrollment::where('classroom_id', $classView->classroom_id)->count();
                    ?>
                    <label class ="control-label">
                        {{$current."/".$classView->capacity}}
                    </label>
                    {{--<select name="capacity" class="form-control">--}}
                        {{--<option value="" disabled selected>Select Maximum Capacity</option>--}}
                        {{--@for ($i = 10; $i <= 200; $i+=5)--}}
                            {{--<option value="{{$i}}">{{$i}}</option>--}}
                        {{--@endfor--}}

                    {{--</select>--}}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-3 control-label"></label>
                <div class="col-xs-1">
                    <a class="btn btn-default btn-block btn-flat" href="{{ route('l_viewAllClassroom') }}">Back</a>
                </div>
                <div class="col-xs-2">
                    <a class="btn btn-primary btn-block btn-flat" href="{{ route('l_editClassroomEK', $classView->classroom_id) }}">Change Enrollment Key</a>
                </div>
                <div class="col-xs-2">
                    <a class="btn btn-primary btn-block btn-flat" href="{{ route('lecturerClassroomOperation.edit', $classView->classroom_id) }}">Edit Details</a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.box-header -->
        <div class="box-header">
            <h3 class="box-title">List of <b>Students Enrolled</b></h3>
        </div>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>NO</th>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>PROGRAM</th>
                    <th><span class="pull-right">OPERATION(S)</span></th>
                </tr>
                @if($students->count() >= 1)
                    <?php $x = 1; ?>
                    @foreach($students as $student)
                        <tr>
                            <th>{{$x}}</th>
                            <th>{{$student->studentprofile->id}}</th>
                            <th>{{$student->studentprofile->name}}</th>
                            <th>{{$student->studentprofile->programme->name}}</th>
                            <th></th>
                        </tr>
                            <?php $x++; ?>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">No students enrolled to this class.</td>
                    </tr>
                @endif
            </table>
        </div>
        {{--box-body--}}
    </div>
        <!-- /.box -->
@stop()
