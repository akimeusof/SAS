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
    {!!
        Form::open(array('class' => 'form-horizontal',
                          'route' => 'handleNewAdmin'
                  ))
        !!}
    <!-- Default box -->
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">List of <b>Lecturers</b></h3>
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
                    @foreach($lecturers as $lecturer)
                        <tr>
                            <td><center>{{$x}}</center></td>
                            <td>{{$lecturer->lecturerprofile->id}}</td>
{{--                            <td>{{$lecturer->username}}</td>--}}
                            <td>{{$lecturer->lecturerprofile->name}}</td>
                            <td>{{$lecturer->lecturerprofile->email}}</td>
                            <td>
                            <span class="pull-right">
                            <div class="btn-group-vertical">
                                <a href="{{ route('lecturerOperation.show', $lecturer->id) }}" class="btn btn-info">View User</a>
                            </div>
                            <div class="btn-group-vertical">
                                <a href="{{ route('lecturerOperation.edit', $lecturer->id) }}" class="btn btn-success">Edit User</a>
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
                                {!! Form::open(['method' => 'DELETE', 'route' => ['lecturerOperation.destroy', $lecturer->id]]) !!}
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
            {{--</div>--}}
            {{--box-body--}}
        </div>
        <!-- /.box -->
@stop()