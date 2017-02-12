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
            <center><h3><b>{{ strtoupper($user->username)}}</b>'s Profile</h3></center>
        </div>
        <div class="box-body">
            {!! Form::model($user, array(
                       'method' => 'patch',
                       'class' => 'form-horizontal',
                       'route' => ['adminOperation.update', $user->id]
                       )) !!}
            <div class ="form-group">
                <label class="col-sm-4 control-label">Username:</label>
                <div class="col-xs-4">
                    {{--<label class="control-label">{{$user->username}}</label>--}}
                    {!! Form::text('name', isset($user)?$user->username:"", array('class' => 'form-control', 'readonly')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">ID:</label>
                <div class="col-xs-4">
                    {{--<label class="control-label">{{isset($user->adminprofile)?$user->adminprofile->id:"No Data"}}</label>--}}
                    {!! Form::text('name', isset($user->adminprofile)?$user->adminprofile->id:"", array('class' => 'form-control', 'readonly')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Name:</label>
                <div class="col-xs-4">
{{--                    <label class="control-label">{{isset($user->adminprofile)?$user->adminprofile->name:"No Data"}}</label>--}}
                    {!! Form::text('name', isset($user->adminprofile)?$user->adminprofile->name:"", array('class' => 'form-control', 'readonly')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Email:</label>
                <div class="col-xs-4">
                    {!! Form::email('email', isset($user->adminprofile)?$user->adminprofile->email:"No Data", array('class' => 'form-control', 'readonly')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Phone #:</label>
                <div class="col-xs-4">
                    {!! Form::text('phonenumber', isset($user->adminprofile)?$user->adminprofile->phonenumber:"No Data", array('class' => 'form-control', 'readonly')) !!}
{{--                    <label class="control-label">{{isset($user->adminprofile)?$user->adminprofile->phonenumber:"No Data"}}</label>--}}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Home #:</label>
                <div class="col-xs-4">
                    {!! Form::text('homenumber', isset($user->adminprofile)?$user->adminprofile->homenumber:"No Data", array('class' => 'form-control', 'readonly')) !!}
                    {{--<label class="control-label">{{isset($user->adminprofile)?$user->adminprofile->homenumber:"No Data"}}</label>--}}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">Address:</label>
                <div class="col-xs-4">
                    {!! Form::textarea('phonenumber', isset($user->adminprofile)?$user->adminprofile->phonenumber:"No Data", array('class' => 'form-control', 'readonly', 'rows' => '5')) !!}
{{--                    <label>{!! isset($user->adminprofile)?nl2br(e($user->adminprofile->address)):"No Data" !!}</label>--}}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"></label>
                <div class="col-xs-2">
                    <a class="btn btn-default btn-block btn-flat" href="{{ URL::previous() }}">Cancel</a>
                </div>
                <div class="col-xs-2">
                    {{--<input type="hidden" name="type" value="admin">--}}
                    {{--<input type="hidden" name="status" value="1">--}}
                    <a class="btn btn-primary btn-block btn-flat" href="{{ route('adminOperation.edit', $user->id) }}">Edit</a>
{{--                    {!! Form::submit('Submit', array('class' => 'btn btn-primary btn-block btn-flat')) !!}--}}
                </div>
            </div>

        </div>
    {!! Form::close() !!}

    <!-- /.box-body -->
        <div class="box-header">
            <h3 class="box-title">List of <b>Admins</b></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th><center>NO</center></th>
                    <th><center>STAFF ID</center></th>
                    {{--<th>USERNAME</th>--}}
                    <th>NAME</th>
                    <th>E-MAIL</th>
                    <th><span class="pull-right">OPERATIONS</span></th>
                </tr>
                <?php $x = 1; ?>
                @foreach($admins as $admin)
                    <tr>
                        <td><center>{{$x}}</center></td>
                        <td><center>{{isset($admin->adminProfile)?$admin->adminProfile->id:""}}</center></td>
                        {{--                        <td>{{isset($admin)?$admin->username:""}}</td>--}}
                        <td>{{isset($admin->adminProfile)?$admin->adminProfile->name:""}}</td>
                        <td>{{isset($admin->adminProfile)?$admin->adminProfile->email:""}}</td>
                        <td>
                            <span class="pull-right">
                                <div class="btn-group-vertical">
                                    <a href="{{ route('adminOperation.show', $admin->id) }}" class="btn btn-info">View User</a>
                                </div>
                                <div class="btn-group-vertical">
                                    <a href="{{ route('adminOperation.edit', $admin->id) }}" class="btn btn-success">Edit User</a>
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
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['adminOperation.destroy', $admin->id]]) !!}
                                    {!! Form::submit('Delete User', array('class' => 'btn btn-warning', 'onClick' => 'return ConfirmDelete()')) !!}
                                    {!! Form::close() !!}
                                </div>
                            </span>
                        </td>

                    </tr>
                    <?php $x++; ?>
                @endforeach
            </table>
        </div>
    <!-- /.box-body -->
</div>
                        <!-- /.box -->
@stop()