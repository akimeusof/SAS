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
                      'route' => 'semesterOperation.store'
              ))
    !!}
<!-- Default box -->
    <div class="box">
        <div class="box-header">
            <center><h3><b>Create</b> New <b>Semester</b></h3></center>
        </div>
        <div class="box-body">
            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Semester Name:</label>
                <div class="col-xs-4">
                    {!! Form::text('semester_name', null, array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Start Date:</label>
                <div class="col-xs-4">
                    {!! Form::date('start_date', null, array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label">* End Date:</label>
                <div class="col-xs-4">
                    {!! Form::date('end_date', null, array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"></label>
                <div class="col-xs-2">
                    <a class="btn btn-default btn-block btn-flat" href="{{ route('semesters') }}">Cancel</a>
                </div>
                <div class="col-xs-2">
                    <input type="hidden" name="type" value="admin">
                    <input type="hidden" name="status" value="1">

                    {!! Form::submit('Submit', array('class' => 'btn btn-primary btn-block btn-flat')) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>

        <div class="box-header">
            <h3 class="box-title">List of <b>Semesters</b></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th><center>NO</center></th>
                    <th>SEMESTER</th>
                    <th><center>START DATE</center></th>
                    <th><center>END DATE</center></th>
                    <th><span class="pull-right">OPERATIONS</span></th>
                </tr>
                <?php $x = 1; ?>
                @if($semesters->count() >= 1)
                @foreach($semesters as $semester)
                    <tr>
                        <td><center>{{$x}}</center></td>
                        <td>{{$semester->semester}}</td>
                        <td><center>{{isset($semester->start)?date_format($semester->start, 'd-m-Y'):""}}</center></td>
                        <td><center>{{isset($semester->end)?date_format($semester->end, 'd-m-Y'):""}}</center></td>
                        <td>
                            <span class="pull-right">
                                <div class="btn-group-vertical">
                                    <a href="{{ route('semesterOperation.edit', $semester->semester_id) }}" class="btn btn-success">Edit Semester</a>
                                </div>
                                <div class="btn-group-vertical">
                                    <script>
                                        function ConfirmDelete()
                                        {
                                            var x = confirm("Are you sure you want to delete this semester?");
                                            if (x) {
                                                return true;
                                            }
                                            else {
                                                return false;
                                            }
                                        }
                                    </script>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['semesterOperation.destroy', $semester->semester_id]]) !!}
                                    {!! Form::submit('Remove Semester', array('class' => 'btn btn-warning', 'onClick' => 'return ConfirmDelete()')) !!}
                                    {!! Form::close() !!}
                                </div>
                            </span>
                        </td>

                    </tr>
                    <?php $x++; ?>
                @endforeach
                @else
                    <tr>

                    </tr>
                @endif
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@stop()