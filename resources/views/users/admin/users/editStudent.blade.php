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
    {!! Form::model($student, array(
                                  'method' => 'patch',
                                  'class' => 'form-horizontal',
                                  'route' => ['studentOperation.update', $student->id]

                              )) !!}
    <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <center><h3><b>{{ strtoupper($student->username)}}</b>'s Profile</h3></center>
            </div>
            <div class="box-body">
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">* Username:</label>
                    <div class="col-xs-4">
                        {{--<strong>{{ $lecturer->username }}</strong>--}}
                        {!! Form::text('username', isset($student)?$student->username:"", array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">* Name:</label>
                    <div class="col-xs-4">
                        {!! Form::text('name', isset($student->studentprofile)?$student->studentprofile->name:"", array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">* E-Mail:</label>
                    <div class="col-xs-4">
                        {!! Form::email('email', isset($student->studentprofile)?$student->studentprofile->email:"", array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">* ID:</label>
                    <div class="col-xs-4">
                        {!! Form::text('id', isset($student->studentprofile)?$student->studentprofile->id:"", array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">* Programme:</label>
                    <div class="col-xs-4">
                        <select name="programme_id" class="form-control">
                            @if(isset($student->studentprofile->programme))
                                <option value="{{$student->studentprofile->programme_id}}" selected>{{$student->studentprofile->programme->name}}</option>
                            @else
                                <option value="" disabled selected>Choose Programme</option>
                            @endif
                            @foreach($programmes as $programme)
                                @if($programme->programme_id != $student->studentprofile->programme_id)
                                <option value="{{$programme->programme_id}}">{{$programme->name}}</option>
                                @endif
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">Phone #:</label>
                    <div class="col-xs-4">
                        {!! Form::text('phonenumber', isset($student->studentprofile)?$student->studentprofile->phonenumber:"", array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">Home #:</label>
                    <div class="col-xs-4">
                        {!! Form::text('homenumber', isset($student->studentprofile)?$student->studentprofile->homenumber:"", array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">Address:</label>
                    <div class="col-xs-4">
                        {!! Form::textarea('address', isset($student->studentprofile)?$student->studentprofile->address:"", array('class' => 'form-control', 'rows' => '5')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label"></label>
                    <div class="col-xs-2">
                        <a class="btn btn-default btn-block btn-flat" href="{{ route('viewAllStudent') }}">Cancel</a>
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