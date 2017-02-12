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
                          'route' => 'lecturerOperation.edit'
                  ))
        !!}
    <!-- Default box -->
        <div class="box">
            <div class="box-body">
                <div class="box-header">
                    <center><h3><b>{{ strtoupper($lecturer->username)}}</b>'s Profile</h3></center>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">Username:</label>
                    <div class="col-xs-4">
                        {{--<strong>{{ $lecturer->username }}</strong>--}}
                        {!! Form::text('username', $lecturer->username, array('class' => 'form-control', 'readonly')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">E-Mail:</label>
                    <div class="col-xs-4">
                        {!! Form::email('email', $lecturer->lecturerprofile->email, array('class' => 'form-control', 'readonly')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">ID:</label>
                    <div class="col-xs-4">
                        {!! Form::text('id', $lecturer->lecturerprofile->id, array('class' => 'form-control', 'readonly')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">Name:</label>
                    <div class="col-xs-4">
                        {!! Form::text('name', $lecturer->lecturerprofile->name, array('class' => 'form-control', 'readonly')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">Phone #:</label>
                    <div class="col-xs-4">
                        {!! Form::text('phonenumber', $lecturer->lecturerprofile->phonenumber, array('class' => 'form-control', 'readonly')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">Home #:</label>
                    <div class="col-xs-4">
                        {!! Form::text('homenumber', $lecturer->lecturerprofile->homenumber, array('class' => 'form-control', 'readonly')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">Address:</label>
                    <div class="col-xs-4">
                        {!! Form::textarea('address', $lecturer->lecturerprofile->address, array('class' => 'form-control', 'rows' => '5', 'readonly')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label"></label>
                    <input type="hidden" name="type" value="admin">
                    <input type="hidden" name="status" value="1">
                    <div class="col-xs-2">
                        <a class="btn btn-default btn-block btn-flat" href="{{ route('viewAllLecturer') }}">Back</a>
                    </div>
                    <div class="col-xs-2">
                        <a href="{{ route('lecturerOperation.edit', $lecturer->id) }}" class="btn btn-primary btn-block btn-flat">Edit</a>
                    </div>
                </div>

            </div>
        {!! Form::close() !!}

        <!-- /.box-body -->
            <div class="box-footer">

            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
@stop()