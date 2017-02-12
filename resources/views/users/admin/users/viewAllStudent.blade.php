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
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">List of <b>Students</b></h3>
        </div>
        <div class="box-body">
            {{--<div class="box-body table-responsive no-padding">--}}
                <table class="table table-hover">
                    <tr>
                        <th><center>NO</center></th>
                        <th>ID</th>
                        {{--<th>USERNAME</th>--}}
                        <th>NAME</th>
                        <th>E-MAIL</th>
                        <th><span class="pull-right">OPERATIONS</span></th>
                    </tr>
                    <?php $x = 1; ?>
                    @foreach($students as $student)
                        <tr>
                            <td><center>{{$x}}</center></td>
                            <td>{{isset($student->studentprofile)?$student->studentprofile->id:""}}</td>
{{--                            <td>{{isset($student)?$student->username:""}}</td>--}}
                            <td>{{isset($student->studentprofile)?$student->studentprofile->name:""}}</td>
                            <td>{{isset($student->studentprofile)?$student->studentprofile->email:""}}</td>
                            <td>
                                <span class="pull-right">
                                <div class="btn-group-vertical">
                                    <a href="{{ route('studentOperation.show', $student->id) }}" class="btn btn-info">View User</a>
                                </div>
                                <div class="btn-group-vertical">
                                    <a href="{{ route('studentOperation.edit', $student->id) }}" class="btn btn-success">Edit User</a>
                                </div>
                                <div class="btn-group-vertical">
                                    <script>
                                        function ConfirmDelete()
                                        {
                                            var x = confirm("Are you sure you want to delete this user?");
                                            if (x) {
                                                return true;
                                            }
                                            else {
                                                return false;
                                            }
                                        }
                                    </script>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['studentOperation.destroy', $student->id]]) !!}
                                    {!! Form::submit('Delete User', array('class' => 'btn btn-warning', 'onClick' => 'return ConfirmDelete()')) !!}
                                    {!! Form::close() !!}
                                </div>
                                    </span>
                            </td>
                        </tr>
                        <?php $x++; ?>
                    @endforeach
                    <tr>
                        <th><center>NO</center></th>
                        <th>ID</th>
                        {{--<th>USERNAME</th>--}}
                        <th>NAME</th>
                        <th>E-MAIL</th>
                        <th><span class="pull-right">OPERATIONS</span></th>
                    </tr>
                </table>
        </div>
            {{--box-body--}}
    </div>
            <!-- /.box -->
@stop()