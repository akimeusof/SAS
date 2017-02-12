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
                          'route' => 'lecturerOperation.store'
                  ))
        !!}
    <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <center><h3><b>Create</b> New <b>Lecturer</b></h3></center>
            </div>
            <div class="box-body">

                <div class ="form-group">
                    <label class ="col-sm-4 control-label">* Username:</label>
                    <div class="col-xs-4">
                        {{--<strong>{{ $lecturer->username }}</strong>--}}
                        {!! Form::text('username', null, array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">* Staff ID:</label>
                    <div class="col-xs-4">
                        {!! Form::text('id', null, array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">* Name:</label>
                    <div class="col-xs-4">
                        {!! Form::text('name', null, array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">* E-Mail:</label>
                    <div class="col-xs-4">
                        {!! Form::email('email', null, array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">Phone #:</label>
                    <div class="col-xs-4">
                        {!! Form::text('phonenumber', null, array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">Home #:</label>
                    <div class="col-xs-4">
                        {!! Form::text('homenumber', null, array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">Address:</label>
                    <div class="col-xs-4">
                        {!! Form::textarea('address', null, array('class' => 'form-control', 'rows' => '5')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label"></label>
                    <input type="hidden" name="type" value="lecturer">
                    <input type="hidden" name="status" value="1">
                    <div class="col-xs-2">
                        <a class="btn btn-default btn-block btn-flat" href="{{ route('newLecturer') }}">Cancel</a>
                    </div>
                    <div class="col-xs-2">
                        {!! Form::submit('Submit', array('class' => 'btn btn-primary btn-block btn-flat')) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
@stop()