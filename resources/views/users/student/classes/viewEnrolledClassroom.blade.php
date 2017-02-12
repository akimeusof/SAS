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
                <b>List</b> of <b>Classes Enrolled</b> for <b>{{strtoupper(\Auth::user()->studentprofile->name)}}</b>
            </h3>
        </div>
        <div class="box-body">
            <table id="example2" class="table table-hover">
                <thead>
                <tr>
                    <th><center>NO</center></th>
                    <th>SUBJECT</th>
                    <th><center>SECTION</center></th>
                    <th>LECTURER</th>
                    <th><span class="pull-right">OPERATION</span></th>
                </tr>
                </thead>
                <tbody>
                @if($enrollments->count() > 0)
                    <?php $x = 1; ?>
                    @foreach($enrollments as $enrollment)
                        <tr>
                            <td><center>{{$x}}</center></td>
                            <td>{{isset($enrollment->classroom->subject)?$enrollment->classroom->subject->code." - ".$enrollment->classroom->subject->name:""}}</td>
                            <td><center>{{isset($enrollment->classroom)?$enrollment->classroom->section:""}}</center></td>
                            <td>{{isset($enrollment->classroom->lecturerprofile)?$enrollment->classroom->lecturerprofile->name:""}}</td>
                            <td>
                                <span class="pull-right">
                                    {{--if belum enroll button ni--}}
                                    <script>
                                    function ConfirmWithdraw()
                                    {
                                        var x = confirm("Are you sure you want to withdraw/unenroll from this class?");
                                        if (x)
                                            return true;
                                        else
                                            return false;
                                    }
                                </script>
                                <a class="btn btn-success btn flat" href="{{route('s_classDetails', $enrollment->classroom_id)}}">View Classroom Details</a>
                                <a class="btn btn-warning btn-flat" href="{{route('studentClassroomOperation.edit', $enrollment->enrollment_id)}}" onClick="return ConfirmWithdraw();">Withdraw/Unenroll</a>
                                    {{--if dah enroll button ni--}}
                                    {{--<button type="button" c lass="btn btn-info btn-block btn-lg" disabled>Click Me!</button>--}}
                                </span>
                            </td>
                        </tr>
                        <?php $x++; ?>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">
                            You are not enrolled to any class.
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>

        </div>
        {{--box-body--}}

    </div>
    <!-- /.box -->
@stop()
