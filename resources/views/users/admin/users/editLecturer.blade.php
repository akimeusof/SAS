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
    {!! Form::model($lecturer, array(
                                  'method' => 'patch',
                                  'class' => 'form-horizontal',
                                  'route' => ['lecturerOperation.update', $lecturer->id]

                              )) !!}
    <!-- Default box -->
        <div class="box">
            <div class="box-body">
                <div class="box-header">
                    <center><h3><b>{{ strtoupper($lecturer->username)}}</b>'s Profile</h3></center>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">* Username:</label>
                    <div class="col-xs-4">
                        {!! Form::text('username', $lecturer->username, array('class' => 'form-control', 'placeholder' => 'Leave Empty If No Changes')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">* E-Mail:</label>
                    <div class="col-xs-4">
                        {!! Form::email('email', isset($lecturer->lecturerprofile)?$lecturer->lecturerprofile->email:"", array('class' => 'form-control', 'placeholder' => 'Leave Empty If No Changes')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">* ID:</label>
                    <div class="col-xs-4">
                        {!! Form::text('id', isset($lecturer->lecturerprofile)?$lecturer->lecturerprofile->id:"", array('class' => 'form-control', 'placeholder' => 'Leave Empty If No Changes')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">* Name:</label>
                    <div class="col-xs-4">
                        {!! Form::text('name', isset($lecturer->lecturerprofile)?$lecturer->lecturerprofile->name:"", array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">Phone #:</label>
                    <div class="col-xs-4">
                        {!! Form::text('phonenumber', isset($lecturer->lecturerprofile)?$lecturer->lecturerprofile->phonenumber:"", array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">Home #:</label>
                    <div class="col-xs-4">
                        {!! Form::text('homenumber', isset($lecturer->lecturerprofile)?$lecturer->lecturerprofile->homenumber:"", array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">Address:</label>
                    <div class="col-xs-4">
                        {!! Form::textarea('address', isset($lecturer->lecturerprofile)?$lecturer->lecturerprofile->address:"", array('class' => 'form-control', 'rows' => '5')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label"></label>
                    <div class="col-xs-2">
                        <a class="btn btn-default btn-block btn-flat" href="{{ route('viewAllLecturer') }}">Cancel</a>
                    </div>
                    <div class="col-xs-2">
                        {!! Form::submit('Update', array('class' => 'btn btn-success btn-block btn-flat')) !!}
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