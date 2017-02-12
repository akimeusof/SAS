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

{!! Form::open(array('class' => 'form-horizontal',
                                  'route' => 'subjectOperation.store'
                          ))
                !!}<!-- Default box -->
    <div class="box">
        <div class="box-header">
            <center><h3>Edit <b>{{$subject->code." - ".$subject->name}}</b></h3></center>
        </div>
        <div class="box-body">
            <div class ="form-group">
                <label class ="col-sm-5 control-label">Subject Code:</label>
                <div class="col-xs-4">
                    {{--<strong>{{ $lecturer->username }}</strong>--}}
                    <label class ="control-label">{{$subject->code}}</label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-5 control-label">Subject Name:</label>
                <div class="col-xs-4">
                    <label class ="control-label">{{$subject->name}}</label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-5 control-label">Total Chapter:</label>
                <div class="col-xs-4">
                    <label class ="control-label">{{$subject->totalchapter}}</label>
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-3 control-label"></label>
                <div class="col-xs-1">
                    <a class="btn btn-default btn-block btn-flat" href="{{ route('viewAllSubject') }}">Back</a>
                </div>
                <div class="col-xs-2">
                    <a class="btn btn-primary btn-block btn-flat" href="{{ route('addChapters', $subject->subject_id) }}">Add Chapters</a>
                </div>
                <div class="col-xs-2">
                    <a class="btn btn-primary btn-block btn-flat" href="{{ route('subjectOperation.edit', $subject->subject_id) }}">Edit Subject Details</a>
                </div>
            </div>

        </div>
        {!! Form::close() !!}
        <div class="box-header">
            <h3 class="box-title">List of <b>Chapters</b></h3>
        </div>
        <div class="box-body">
            <table id="example2" class="table table-hover">
                <thead>
                <tr>
                    <th><center>NO</center></th>
                    <th><center>Chapter No</center></th>
                    <th>Chapter Name</th>
                    <th><span class="pull-right">Operations</span></th>
                </tr>
                </thead>
                <tbody>
                @if($chapters->count() >= 1)
                <?php $x = 1; ?>
                @foreach($chapters as $chapter)
                    <tr>
                        <td><center>{{$x}}</center></td>
                        <td><center>{{$chapter->chapter_no}}</center></td>
                        <td>{{$chapter->chapter_name}}</td>
                        <td>
                            <span class="pull-right">
                                <div class="btn-group-vertical">
                                    <a href="{{ route('editChapters', $subject->subject_id) }}" class="btn btn-success btn-flat btn-block">Edit Chapter</a>
                                </div>
                                <div class="btn-group-vertical">
                                    <script>
                                        function ConfirmDelete()
                                        {
                                            var x = confirm("Are you sure you want to delete this chapter?");
                                            if (x) {
                                                return true;
                                            }
                                            else {
                                                return false;
                                            }
                                        }
                                    </script>
                                    <a href="{{ route('deleteChapter', $subject->subject_id) }}" class="btn btn-warning btn-flat btn-block">Remove Chapter</a>
                                </div>
                            </span>
                        </td>
                    </tr>
                    <?php $x++; ?>
                @endforeach
                @else
                    <tr>
                        <td colspan="4">No chapters uploaded for this subject.</td>
                    </tr>
                @endif
                </tbody>
            </table>

        </div>
    </div>
    <!-- /.box -->
@stop()