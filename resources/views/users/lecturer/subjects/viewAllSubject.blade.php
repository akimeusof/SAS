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
    <h1>
        <b>List</b> of <b>Subjects</b>
    </h1>
    </section>

    <!-- Main content -->
    <section class="content">

    {!!
        Form::open(array('class' => 'form-horizontal',
                          'route' => 'lecturerSubjectOperation.store'
                  ))
        !!}
    <!-- Default box -->
        <div class="box">
            <div class="box-body">

                <div class ="form-group">
                    <label class ="col-sm-4 control-label">*Subject Code:</label>
                    <div class="col-xs-4">
                        {!! Form::text('code', null, array('class' => 'form-control', 'placeholder' => 'CSEB432')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label">*Subject Name:</label>
                    <div class="col-xs-4">
                        {!! Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Web Programming')) !!}
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-4 control-label"></label>
                    <div class="col-xs-2">
                        <a class="btn btn-warning btn-block btn-flat" href="{{ route('viewAllSubject') }}">Cancel</a>
                    </div>
                    <div class="col-xs-2">
                        <input type="hidden" name="createdby" value="{{\Auth::user()->id}}">
                        <input type="hidden" name="status" value="1">
                        {!! Form::submit('Submit', array('class' => 'btn btn-success btn-block btn-flat')) !!}
                    </div>
                </div>

            </div>
            {!! Form::close() !!}
            <div class="box-header">
                {{--<h3 class="box-title">Hover Data Table</h3>--}}
            </div>
            <div class="box-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="5%">NO</th>
                        <th width="10%">CODE</th>
                        <th width="35%">NAME</th>
                        <th width="35%">ADDED BY</th>
                        <th width="15%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $x = 1; ?>
                    @foreach($subjects as $subject)
                            <tr>
                            <td>{{$x}}</td>
                            <td>{{$subject->code}}</td>
                            <td>{{$subject->name}}</td>
                            <td>
                                <?php
                                    $creator = App\LecturerProfile::where('user_id', $subject->createdby)->get(['name']);
                                ?>
                                    {{$creator}}
                            </td>
                            <td>
                                <div class="btn-group-vertical">
                                    <a href="{{ route('lecturerSubjectOperation.edit', $subject->subject_id) }}" class="btn btn-success">Edit Subject</a>
                                </div>
                                <div class="btn-group-vertical">
                                    @if($subject->createdby == \Auth::user()->id)
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['lecturerSubjectOperation.destroy', $subject->subject_id]]) !!}
                                    {!! Form::submit('Delete Subject', array('class' => 'btn btn-warning')) !!}
                                    {!! Form::close() !!}
                                    @endif
                                </div>
                            </td>
                        </tr>
                    <?php $x++; ?>
                    @endforeach
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