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

    {!! Form::model($subject, array(
                          'method' => 'patch',
                          'class' => 'form-horizontal',
                          'route' => ['subjectOperation.update', $subject->subject_id]

                      )) !!}
<!-- Default box -->
    <div class="box">
        <div class="box-header">
            <center><h3>Edit <b>{{$subject->code." - ".$subject->name}}</b></h3></center>
        </div>
        <div class="box-body">
            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Subject Code:</label>
                <div class="col-xs-4">
                    {{--<strong>{{ $lecturer->username }}</strong>--}}
                    {!! Form::text('code', $subject->code, array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Subject Name:</label>
                <div class="col-xs-4">
                    {!! Form::text('name', $subject->name, array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Total Chapter:</label>
                <div class="col-xs-4">
                    <select class="form-control" name="totalchapter">
                        <option value="{{$subject->totalchapter}}" selected>{{$subject->totalchapter}}</option>
                        @for($i = 1; $i<=20; $i++)
                            @if($i != $subject->totalchapter)
                                <option value="{{$i}}">{{$i}}</option>
                            @endif
                        @endfor
                    </select>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"></label>
                <div class="col-xs-2">
                    <a class="btn btn-default btn-block btn-flat" href="{{ route('viewAllSubject') }}">Cancel</a>
                </div>
                <div class="col-xs-2">
                    {!! Form::submit('Submit', array('class' => 'btn btn-primary btn-block btn-flat')) !!}
                </div>
            </div>

        </div>
        {!! Form::close() !!}
        <div class="box-header">
            <h3 class="box-title">List of <b>Subjects</b></h3>
        </div>
        <div class="box-body">
            <table id="example2" class="table table-hover">
                <thead>
                <tr>
                    <th><center>NO</center></th>
                    <th>Code</th>
                    <th>Name</th>
                    <th><center>Total Chapter</center></th>
                    <th><span class="pull-right">Operations</span></th>
                </tr>
                </thead>
                <tbody>
                <?php $x = 1; ?>
                @foreach($subjects as $subject)
                    <tr>
                        <td><center>{{$x}}</center></td>
                        <td>{{$subject->code}}</td>
                        <td>{{$subject->name}}</td>
                        <td><center>{{$subject->totalchapter}}</center></td>
                        <td>
                            <span class="pull-right">
                                <div class="btn-group-vertical">
                                    <a href="{{ route('subjectOperation.edit', $subject->subject_id) }}" class="btn btn-success btn-flat btn-block">Edit Subject</a>
                                </div>
                                <div class="btn-group-vertical">
                                    <script>
                                        function ConfirmDelete()
                                        {
                                            var x = confirm("Are you sure you want to delete this subject?");
                                            if (x) {
                                                return true;
                                            }
                                            else {
                                                return false;
                                            }
                                        }
                                    </script>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['subjectOperation.destroy', $subject->subject_id]]) !!}
                                    {!! Form::submit('Delete Subject', array('class' => 'btn btn-warning btn-flat btn-block', 'onClick' => 'return ConfirmDelete()')) !!}
                                    {!! Form::close() !!}
                                </div>
                            </span>
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