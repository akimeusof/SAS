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
                <label class ="col-sm-4 control-label"></label>
                <div class="col-xs-4">
                    <a class="btn btn-default btn-block btn-flat" href="{{ route('viewChapters', $subject->subject_id) }}">Cancel</a>
                </div>
            </div>

        </div>
        {!! Form::close() !!}
        <div class="box-header">
            <h3 class="box-title">List of <b>Chapters</b></h3>
        </div>
        <div class="box-body">
            @if($chapters->count() > 0)
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
                <?php $x = 1; ?>
                @foreach($chapters as $chapter)
                    <tr>
                        <td><center>{{$x}}</center></td>
                        <td><center>{!! Form::number('chapter_no[]', $chapter->chapter_no, array('form-control')) !!}</center></td>
                        <td>{!! Form::text('chapter_name[]', $chapter->chapter_name, array('form-control')) !!}</td>
                        <td>
                            <span class="pull-right">
                                <div class="btn-group-vertical">
                                    <a class="btn btn-default btn-block btn-flat" href="{{ route('viewChapters', $subject->subject_id) }}">Delete Chapter</a>
                                </div>
                            </span>
                        </td>
                    </tr>
                    <?php $x++; ?>
                @endforeach
                @for($i = 0; $i<$subject->totalchapter - $chapters->count(); $i++ )
                    <tr>
                        <td><center>{{$x}}</center></td>
                        <td><center>{!! Form::number('chapter_no[]', $chapter->chapter_no, array('form-control')) !!}</center></td>
                        <td>{!! Form::text('chapter_name[]', $chapter->chapter_name, array('form-control')) !!}</td>
                        <td>
                            <span class="pull-right">
                                <div class="btn-group-vertical">
                                    <a class="btn btn-default btn-block btn-flat" href="{{ route('viewChapters', $subject->subject_id) }}">Delete Chapter</a>
                                </div>
                            </span>
                        </td>
                    </tr>
                @endfor
                </tbody>
                </table>
            @else
                <?php $x = 1; ?>
                    <table id="example2" class="table table-hover">
                        <thead>
                        <tr>
                            <th><center>NO</center></th>
                            <th><center>Chapter No</center></th>
                            <th>Chapter Name</th>
                        </tr>
                        </thead>
                        <tbody>
                @for($i = 0; $i<$subject->totalchapter; $i++)
                    <tr>
                        <td><center>{{$x}}</center></td>
                        <td><center>{!! Form::number('chapter_no[]', $chapter->chapter_no, array('form-control')) !!}</center></td>
                        <td>{!! Form::number('chapter_no[]', $chapter->chapter_no, array('form-control')) !!}</td>
                    </tr>
                        </tbody>
                    </table>
                @endfor
            @endif

        </div>
    </div>
    <!-- /.box -->
@stop()