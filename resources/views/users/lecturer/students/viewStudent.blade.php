@extends('layout.layoutSubLecturer')
@section('content')
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
    <h1><b>{{ strtoupper($student->studentprofile->name)}}</b>'s Profile</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            {!! Form::open(array('class' => 'form-horizontal')) !!}
            <div class="box-body">
                <div class ="form-group">
                    <label class ="col-sm-5 control-label"></label>
                    <div class="col-xs-2">
                        <a href="{{url('/avatarStudent')}}">
                            <img src="/uploads/avatar/{{isset($student->studentprofile)?$student->studentprofile->avatar:"default.jpg"}}" class="center-block user-image" title="Change Profile Photo" style="width:250px; height:250px;  border-radius:50%">
                        </a>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label"><h4>Name:</h4></label>
                    <div class="col-xs-4">
                        <label class ="control-label"><h4><b>{{isset($student->studentprofile)?$student->studentprofile->name:"null"}}</b></h4></label>
{{--                        {!! Form::text('name', isset($student->studentprofile)?$student->studentprofile->name:"null", array('class' => 'form-control', 'readonly')) !!}--}}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label"><h4>ID:</h4></label>
                    <div class="col-xs-4">
                        <label class="control-label"><h4><b>{{isset($student->studentprofile)?$student->studentprofile->id:"null"}}</b></h4></label>
{{--                        {!! Form::text('id', isset($student->studentprofile)?$student->studentprofile->id:"null", array('class' => 'form-control', 'readonly')) !!}--}}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label"><h4>Programme:</h4></label>
                    <div class="col-xs-4">
                        <label class="control-label"><h4><b>{{isset($student->studentprofile)?$student->studentprofile->programme->name:"null"}}</b></h4></label>
{{--                        {!! Form::text('programme_id', , array('class' => 'form-control', 'readonly')) !!}--}}
                        {{--                        {!! Form::text('programme_id', $user->studentprofile->programme, array('class' => 'form-control', 'readonly')) !!}--}}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label"><h4>Email:</h4></label>
                    <div class="col-xs-4">
                        <label class="control-label"><h4><b>{{isset($student->studentprofile)?$student->studentprofile->email:"null"}}</b></h4></label>
{{--                        {!! Form::email('email', , array('class' => 'form-control', 'readonly')) !!}--}}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label"><h4>Phone #:</h4></label>
                    <div class="col-xs-4">
                        <label class="control-label"><h4><b>{{isset($student->studentprofile)?$student->studentprofile->phonenumber:"null"}}</b></h4></label>
{{--                        {!! Form::text('phonenumber', isset($student->studentprofile->programme)?$student->studentprofile->phonenumber:"null", array('class' => 'form-control', 'readonly')) !!}--}}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label"><h4>Home #:</h4></label>
                    <div class="col-xs-4">
                        <label class="control-label"><h4><b>{{isset($student->studentprofile)?$student->studentprofile->homenumber:"null"}}</b></h4></label>
                        {{--{!! Form::text('homenumber', isset($student->studentprofile->programme)?$student->studentprofile->homenumber:"null", array('class' => 'form-control', 'readonly')) !!}--}}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label"><h4>Address:</h4></label>
                    <div class="col-xs-4">
                        <label class="control-label"><h4><b>{!! isset($student->studentprofile)?nl2br(e($student->studentprofile->address)):"null" !!}</b></h4></label>
{{--                        {!! Form::textarea('address', , array('class' => 'form-control', 'readonly', 'rows' => '5')) !!}--}}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">Operations:</label>
                    <div class="col-xs-4">
                        <a href="{{URL::previous()}}" class="btn btn-block btn-default btn-lg">Back</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
        @if($classesEnrolled != null)
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th width="3%">NO</th>
                            <th>CLASS (CODE-SUBJECT)</th>
                            <th>SECTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $x = 1; ?>
                        @foreach($classesEnrolled as $classEnrolled)
                            <tr>
                                <td>{{$x}}</td>
                                <td>{{isset($classEnrolled->classroom->subject)?$classEnrolled->classroom->subject->code." - ".$classEnrolled->classroom->subject->name:"No Data"}}</td>
                                <td>{{isset($classEnrolled->classroom)?$classEnrolled->classroom->section:"No Data"}}</td>
                            </tr>
                            <?php $x++; ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    @elseif($classesEnrolled == null)
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th width="3%">NO</th>
                            <th>CLASS(CODE-SUBJECT)</th>
                            <th>SECTION</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3">{{isset($student->studentprofile)?strtoupper($student->studentprofile->name)." is not enrolled to any class.":"This student is not enrolled to any class."}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    @endif
        <!-- /.box -->

@stop()