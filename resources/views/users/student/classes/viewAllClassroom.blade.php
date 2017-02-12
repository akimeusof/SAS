@extends('layout.layoutSubStudent')
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
                <h3>
                    <?php $currentSemester = App\Semester::current()->pluck('semester'); ?>
                    <b>List</b> of <b>Classes</b> for <b>{{isset($currentSemester)?$currentSemester:""}}</b>
                </h3>
                {!! Form::open(array(
                       'class' => 'form-horizontal',
                       'route' => 's_viewAllClassroomFiltered')) !!}
                <br>
                <div class="col-xs-1">
                    <label class ="col-sm-1 control-label">
                        <h4 class="box-title"><b>Filter:</b></h4>
                    </label>
                </div>
                <div class="col-xs-3">
                    <select name="subject_id" class="form-control">
                        @if($filter == 1)
                            <option value="0">All</option>
                                                    <option value="{{$subjectToFilter->subject_id}}" selected>{{$subjectToFilter->code." - ".$subjectToFilter->name}}</option>
                        @foreach($subjects as $subject)
                            @if($subject->subject_id != $subjectToFilter->subject_id)
                                <option value="{{$subject->subject_id}}">{{$subject->code." - ".$subject->name}}</option>
                            @endif
                        @endforeach
                        @else
                            <option value="" selected disabled>Select Subject to Filter</option>
                            @foreach($subjects as $subject)
                                <option value="{{$subject->subject_id}}">{{$subject->code." - ".$subject->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-xs-1">
                    {!! Form::submit('Submit', array('class' => 'btn btn-primary btn-block btn-flat')) !!}
                </div>
                {!! Form::close() !!}
            </div>
            <div class="box-body">
                <table id="example2" class="table table-hover">
                    <thead>
                    <tr>
                        <th width="5%">NO</th>
                        <th width="30%">SUBJECT</th>
                        <th width="5%">SECTION</th>
                        <th width="35">LECTURER</th>
                        <th width="10">CAPACITY</th>
                        <th width="15%">OPERATION</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($classrooms->count() > 0)
                        <?php $x = 1; ?>
                        @foreach($classrooms as $classroom)
                            <tr>
                                <td>{{$x}}</td>
                                <td>{{isset($classroom->subject)?$classroom->subject->code." - ".$classroom->subject->name:""}}</td>
                                <td>{{isset($classroom)?$classroom->section:""}}</td>
                                <td>{{isset($classroom->lecturerprofile)?$classroom->lecturerprofile->name:""}}</td>
                                <td>
                                    <?php
                                        $current = App\Enrollment::where('classroom_id', $classroom->classroom_id)->count();
                                    ?>
                                    {{$current."/".$classroom->capacity}}
                                </td>
                                <td>
                                    <?php
                                    $checkEnrolled = App\Enrollment::where('classroom_id', $classroom->classroom_id, 'AND')->where('user_id', \Auth::user()->id, 'AND')->where('status', 1)->first();
                                    ?>
                                    @if(!$checkEnrolled)
                                        @if($current == $classroom->capacity)
                                            <a class="btn btn-danger btn-block btn-lg disabled" href="#">Class is Fully Enrolled</a>
                                        @else

                                            <a class="btn btn-info btn-block btn-lg" href="{{route('studentClassroomOperation.show', $classroom->classroom_id)}}">Enroll</a>
                                        @endif
                                    @else
                                        <a class="btn btn-success btn-block btn-lg" href="{{route('s_classDetails', $classroom->classroom_id)}}">View Classroom Details</a>
                                    @endif
                                </td>
                            </tr>
                            <?php $x++; ?>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">No class available yet in this semester.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>

            </div>
            {{--box-body--}}

        </div>
        <!-- /.box -->
@stop()
