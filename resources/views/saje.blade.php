@extends('layout.layoutSubAdmin')
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
    <h1>
        <b>List</b> of <b>Subjects</b>
    </h1>
    </section>

    <!-- Main content -->
    <section class="content">

    {!!
        Form::open(array('class' => 'form-horizontal',
                          'route' => 'classroomOperation.store'
                  ))
        !!}
    <!-- Default box -->
        <div class="box">
            <div class="box-body">

                <div class ="form-group">
                    <label class ="col-sm-4 control-label">*Subject:</label>
                    <div class="col-xs-4">
                        {{--<strong>{{ $lecturer->username }}</strong>--}}
                        {!! Form::select('subject', $subjects, null, array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">*Lecturer:</label>
                    <div class="col-xs-4">
                        {!! Form::select('lecturer', $lecturers, null, array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label"></label>
                    <div class="col-xs-2">
                        <a class="btn btn-warning btn-block btn-flat" href="{{ route('viewAllClassroom') }}">Cancel</a>
                    </div>
                    <div class="col-xs-2">
                        {!! Form::submit('Submit', array('class' => 'btn btn-success btn-block btn-flat')) !!}
                    </div>
                </div>

            </div>
            {!! Form::close() !!}
            <div class="box-header">
                <h3 class="box-title">Hover Data Table</h3>
            </div>
            <div class="box-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="5%">NO</th>
                        <th width="15%">Code</th>
                        <th width="66">Name</th>
                        <th width="14%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $x = 1; ?>
                    {{--@foreach($user as $asd)--}}
                    <tr>
                        <td>{{$x}}</td>
                        <td>{{$user->id}}</td>
                        <td></td>
                        <td>
                            {{--<div class="btn-group-vertical">--}}
                            {{--<a href="{{ route('subjectOperation.edit', $classroom->id) }}" class="btn btn-success">Edit Subject</a>--}}
                            {{--</div>--}}
                            {{--<div class="btn-group-vertical">--}}
                            {{--{!! Form::open(['method' => 'DELETE', 'route' => ['subjectOperation.destroy', $classroom->id]]) !!}--}}
                            {{--{!! Form::submit('Delete Subject', array('class' => 'btn btn-warning')) !!}--}}
                            {{--{!! Form::close() !!}--}}
                            {{--</div>--}}
                        </td>
                    </tr>
                    <?php $x++; ?>
                    {{--@endforeach--}}
                    </tbody>
                </table>

            </div>
            {{--box-body--}}

            <div class="box-footer">

            </div>
            {{--box-footer--}}
        </div>
        <!-- /.box -->
@stop()


        <?php

        foreach($lecturer->subjects as $subject){
        ?>
        <li>{{$subject->code." - ".$subject->name}}</li>
    <?php
    }
    ?>