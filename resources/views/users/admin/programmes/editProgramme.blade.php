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
    {!! Form::model($programmeSelected, array(
                              'method' => 'patch',
                              'class' => 'form-horizontal',
                              'route' => ['classroomOperation.update', $programmeSelected->programme_id]

                          )) !!}
<!-- Default box -->
    <div class="box">
        <div class="box-header">
            <center><h3>Edit <b>Programme</b></h3></center>
        </div>
        <div class="box-body">
            <div class ="form-group">
                <label class ="col-sm-4 control-label">* Programme Name:</label>
                <div class="col-xs-4">
                    {!! Form::text('semester_name', $programmeSelected->name, array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class ="form-group">
                <label class ="col-sm-4 control-label"></label>
                <div class="col-xs-2">
                    <a class="btn btn-default btn-block btn-flat" href="{{ route('programmes') }}">Cancel</a>
                </div>
                <div class="col-xs-2">
                    {!! Form::submit('Submit', array('class' => 'btn btn-primary btn-block btn-flat')) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>

        <div class="box-header">
            <h3 class="box-title">List of <b>Programmes</b></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th><center>NO</center></th>
                    <th>NAME</th>
                    <th><span class="pull-right">OPERATIONS</span></th>
                </tr>
                <?php $x = 1; ?>
                @if($programmes->count() >= 1)
                    @foreach($programmes as $programme)
                        <tr>
                            <td><center>{{$x}}</center></td>
                            <td>{{$programme->name}}</td>
                            <td>
                            <span class="pull-right">
                                <div class="btn-group-vertical">
                                    <a href="{{ route('programmeOperation.edit', $programme->programme_id) }}" class="btn btn-success">Edit Programme</a>
                                </div>
                                <div class="btn-group-vertical">
                                    <script>
                                        function ConfirmDelete()
                                        {
                                            var x = confirm("Are you sure you want to delete this programme?");
                                            if (x) {
                                                return true;
                                            }
                                            else {
                                                return false;
                                            }
                                        }
                                    </script>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['programmeOperation.destroy', $programme->programme_id]]) !!}
                                    {!! Form::submit('Remove Programme', array('class' => 'btn btn-warning', 'onClick' => 'return ConfirmDelete()')) !!}
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