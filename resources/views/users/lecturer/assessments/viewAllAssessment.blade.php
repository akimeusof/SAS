@extends('layout.layoutSubLecturer')
@section('content')
    <script>
        function ConfirmActivateAssessment()
        {
            var x = confirm("Are you sure you want to activate this assessment?");
            if (x) {
                return true;
            }
            else {
                return false;
            }
        }
        function ConfirmDeactivateAssessment()
        {
            var x = confirm("Are you sure you want to deactivate this assessment?");
            if (x) {
                return true;
            }
            else {
                return false;
            }
        }
        function ConfirmTerminate()
        {
            var x = confirm("Are you sure you want to terminate this assessment? You cannot undo this operation once you have confirmed.");
            if (x) {
                return true;
            }
            else {
                return false;
            }
        }
    </script>
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
            <h3><b>List</b> of <b>Assessments</b></h3>
            {!! Form::open(array(
                   'class' => 'form-horizontal',
                   'route' => 'l_viewAllAssessmentFiltered')) !!}
            <br>
            <div class="col-xs-1">
                <label class ="col-sm-1 control-label">
                    <h4 class="box-title"><b>Semester:</b></h4>
                </label>
            </div>
            <div class="col-xs-3">
                <select name="semester_id" class="form-control">
                    @if($selected == 0)
                        <option value="" disabled selected>Select Semester to Filter</option>
                        {{--<option value="0">All</option>--}}
                    @foreach($semesters as $semester)
                            <option value="{{$semester->semester_id}}">{{$semester->semester}}</option>
                        @endforeach
                    @elseif($selected == 1)
                        <option value="{{$semesterSelected->semester_id}}" selected>{{$semesterSelected->semester}}</option>
                        <option value="0">View All</option>
                    @foreach($classrooms as $classroom)
{{--                            @if($classroom->classroom_id != $classroomSelected->classroom_id)--}}
                            <option value="{{$classroom->classroom_id}}">{{$classroom->subject->code." - ".$classroom->subject->name." - ".$classroom->section}}</option>
                            {{--@endif--}}
                        @endforeach
                    @endif


                </select>
            </div>
            <div class="col-xs-1">
                {!! Form::submit('Submit', array('class' => 'btn btn-primary btn-block btn-flat')) !!}
            </div>
            {!! Form::close() !!}

            <div class="box-tools">
                <br>
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
                <thead>
                <tr>
                    <th><center>NO</center></th>
                    <th>SEMESTER</th>
                    <th>CLASS (CODE-SUBJECT-SECTION)</th>
                    {{--<th>SECTION</th>--}}
                    <th>ASSESSMENT NAME</th>
                    <th>START TIME</th>
                    <th>END TIME</th>
                    <th>TIME LIMIT</th>
                    <th>STATUS</th>
                    <th><span class="pull-right"></span></th>
                </tr>
                </thead>
                <tbody>
                <?php $x = 1; ?>
                @foreach($assessments as $assessment)
                        <tr>
                            <td><center>{{$x}}</center></td>
                            <td>{{isset($assessment->classroom->semester)?$assessment->classroom->semester->semester:"No Data"}}</td>
                            <td>{{isset($assessment->classroom->subject)?$assessment->classroom->subject->code." - ".$assessment->classroom->subject->name." - ".$assessment->classroom->section:"NO DATA"}}</td>
{{--                            <td>{{isset($assessments->classroom)?$assessments->section:""}}</td>--}}
                            <td>{{isset($assessment)?$assessment->assessmentname:""}}</td>
                            <td>{{isset($assessment)?$assessment->start:""}}</td>
                            <td>{{isset($assessment)?$assessment->end:""}}</td>
                            <td>{{isset($assessment)?$assessment->duration." minutes":""}}</td>
                            <td>
                                @if(($assessment->status == 0))
                                    <b>Not Active</b>
                                @elseif($assessment->status == 1)
                                    <b>Active</b>
                                @endif
                            </td>
                            <td>
                                <span class="pull-right">
                                <div class="btn-group-vertical">
                                        <a href="{{route('lecturerAssessmentOperation.show', $assessment->assessment_id)}}" class="btn btn-primary">View Details</a>
                                </div>
                                    @if(($assessment->status == 0))
                                        <div class="btn-group-vertical">
                                            {!! Form::open(array(
                                                  'class' => 'form-horizontal',
                                                  'route' => 'l_assessmentOperationUpdateStatus',
                                                  'onsubmit' => 'return ConfirmActivateAssessment()')) !!}
                                            <input type="hidden" value="1" name="changeStatus">
                                            <input type="hidden" value="{{$assessment->assessment_id}}" name="assessment_id">
                                            {!! Form::submit('Activate', array('class' => 'btn btn-success')) !!}
                                            {{--                                    <a href="{{route('lecturerAssessmentOperation.edit', $assessment->assessment_id)}}" class="btn btn-success">Activate</a>--}}
                                            {!! Form::close() !!}
                                        </div>
                                        <div class="btn-group-vertical">
                                            {!! Form::open(array(
                                                'class' => 'form-horizontal',
                                                'route' => 'l_assessmentOperationUpdateStatus',
                                                'onsubmit' => 'return ConfirmDeactivateAssessment()')) !!}
                                            <input type="hidden" value="0" name="changeStatus">
                                                <input type="hidden" value="{{$assessment->assessment_id}}" name="assessment_id">
                                            {!! Form::submit('Deactivate', array('class' => 'btn btn-warning', 'disabled' => 'disabled')) !!}
                                            {{--                        {!! Form::submit('Delete Question(s)', array('class' => 'btn btn-block btn-success', 'onClick' => 'return ConfirmDelete()'))!!}--}}
                                            {!! Form::close() !!}
                                         </div>
                                    @elseif($assessment->status == 1)
                                        <div class="btn-group-vertical">
                                            {!! Form::open(array(
                                              'class' => 'form-horizontal',
                                              'route' => 'l_assessmentOperationUpdateStatus',
                                              'onsubmit' => 'return ConfirmActivateAssessment()')) !!}
                                            <input type="hidden" value="1" name="changeStatus">
                                            <input type="hidden" value="{{$assessment->assessment_id}}" name="assessment_id">
                                            {!! Form::submit('Activate', array('class' => 'btn btn-success', 'disabled' => 'disabled')) !!}
                                            {!! Form::close() !!}
                                        </div>
                                        <div class="btn-group-vertical">
                                            {!! Form::open(array(
                                                'class' => 'form-horizontal',
                                                'route' => 'l_assessmentOperationUpdateStatus',
                                                'onsubmit' => 'return ConfirmDeactivateAssessment()')) !!}
                                                <input type="hidden" value="0" name="changeStatus">
                                                <input type="hidden" value="{{$assessment->assessment_id}}" name="assessment_id">
                                                {!! Form::submit('Deactivate', array('class' => 'btn btn-warning')) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    @endif
                                    <div class="btn-group-vertical">
                                        <a href="{{route('l_terminateAssessment', $assessment->assessment_id)}}" onClick="return ConfirmTerminate()" class="btn btn-danger">Terminate</a>
                                </div>
                                </span>
                            </td>
                        </tr>
                        <?php $x++; ?>
                @endforeach
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
