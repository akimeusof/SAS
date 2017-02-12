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
<!-- Default box -->
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">List of <b>Classes</b></h3>
            {!! Form::open(array(
                  'class' => 'form-horizontal',
                  'route' => 'viewAllClassroomFiltered')) !!}
            <br>
            <div class="col-xs-1">
                <label class ="col-sm-1 control-label">
                    <h4 class="box-title"><b>Filter:</b></h4>
                </label>
            </div>
            <div class="col-xs-3">
                <select name="subject_id" class="form-control">
                    @if($s_selected == 0)
                        <option value="" disabled selected>Select Subject CODE-NAME to Filter</option>
                        {{--<option value="0">All</option>--}}
                        @foreach($subjects as $subject)
                            <option value="{{$subject->subject_id}}">{{$subject->code." - ".$subject->name}}</option>
                        @endforeach
                    @else
                        <option value="0">All</option>
                        <option value="{{$subjectSelected->subject_id}}" selected>{{$subjectSelected->code." - ".$subjectSelected->name}}</option>
                        @foreach($subjects as $subject)
                            @if($subject->subject_id != $subjectSelected->subject_id)
                                <option value="{{$subject->subject_id}}">{{$subject->code." - ".$subject->name}}</option>
                            @endif
                        @endforeach
                    @endif


                </select>
            </div>
            <div class="col-xs-1">
                {!! Form::submit('Submit', array('class' => 'btn btn-primary btn-block btn-flat')) !!}
            </div>
            {!! Form::close() !!}
        </div>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th><center>NO</center></th>
                    <th>SUBJECT</th>
                    <th><center>SECTION</center></th>
                    <th>NAME</th>
                    <th><center>CAPACITY</center></th>
                    <th>SEMESTER</th>
                    <th><span class="pull-right">OPERATION(S)</span></th>
                </tr>
                @if($classrooms->count() >= 1)
                    <?php $x = 1; ?>
                    @foreach($classrooms as $classroom)
                        <tr>
                            <td><center>{{$x}}</center></td>
                            <td>{{isset($classroom->subject)?$classroom->subject->code." - ".$classroom->subject->name:""}}</td>
                            <td><center>{{isset($classroom)?strtoupper($classroom->section):""}}</center></td>
                            <td>{{isset($classroom->lecturerprofile)?$classroom->lecturerprofile->name:""}}</td>
                            <td>
                                <?php
                                $current = App\Enrollment::where('classroom_id', $classroom->classroom_id)->count();
                                ?>
                                <center>{{$current."/".$classroom->capacity}}</center>
                            </td>
                            <td>{{$classroom->semester->semester}}</td>
                            <td><span class="pull-right">
                                <div class="btn-group-vertical">
                                    <a href="{{route('classroomOperation.edit', $classroom->classroom_id)}}" class="btn btn-success">Edit Class</a>
                                </div>
                                <div class="btn-group-vertical">
                                    <script>
                                        function ConfirmDelete()
                                        {
                                            var x = confirm("Are you sure you want to delete this class?");
                                            if (x) {
                                                return true;
                                            }
                                            else {
                                                return false;
                                            }
                                        }
                                    </script>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['classroomOperation.destroy', $classroom->classroom_id]]) !!}
                                    {!! Form::submit('Terminate Class', array('class' => 'btn btn-warning', 'onClick' => 'return ConfirmDelete()')) !!}
                                    {!! Form::close() !!}
                                </div>
                                </span>
                            </td>
                        </tr>
                        <?php $x++; ?>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">No record <available class=""></available></td>
                    </tr>
                @endif

            </table>
        </div>
    </div>
        <!-- /.box-body -->

        <!-- /.box -->
@stop()
