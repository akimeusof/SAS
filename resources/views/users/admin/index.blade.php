@extends('layout.layoutSubAdmin')
@section('content')
    {{--<h1>--}}
        {{--Admin Index page--}}
        {{--<small>it all starts here</small>--}}
    {{--</h1>--}}
    {{--<ol class="breadcrumb">--}}
        {{--<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>--}}
        {{--<li><a href="#">Examples</a></li>--}}
        {{--<li class="active">Blank page</li>--}}
    {{--</ol>--}}

</section>

    <!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-danger box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Welcome <b>{{strtoupper(\Auth::user()->username)}}</b></h3>
            {{--<div class="box-tools pull-right">--}}
                {{--<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">--}}
                    {{--<i class="fa fa-minus"></i></button>--}}
                {{--<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">--}}
                    {{--<i class="fa fa-times"></i></button>--}}
            {{--</div>--}}
        </div>
        <div class="box-body">
            <div class="box box-default box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Users</b> Summary</h3>
                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <?php
                        $countUnique = count($getUnique);
                    ?>
                <div class="info-box">
                    <!-- Apply any bg-* class to to the icon to color it -->
                    <span class="info-box-icon bg-grey"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><h4>TOTAL USER</h4></span>
                        <span class="info-box-number">{{$users->count()}}</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                @foreach($getUnique as $type)
                                    <th>
                                        {{--<center>--}}
                                            <div class="info-box">
                                                <!-- Apply any bg-* class to to the icon to color it -->
                                                <?php
                                                    if($type == "admin"){
                                                        $route = "newAdmin";
                                                        $color = "red";
                                                    }elseif($type == "lecturer"){
                                                        $route = "viewAllLecturer";
                                                        $color = "green";
                                                    }elseif($type == "student"){
                                                        $route = "viewAllStudent";
                                                        $color = "blue";
                                                    }else{
                                                        $route = "admin.index";
                                                        $color = "white";
                                                    }

                                                    $admins = App\User::all()->where('type', $type);
                                                    $countAdmin = $admins->count();
                                                    $countAdminActive = $admins->where('status', 1)->count();
                                                    $countAdminNonActive = $admins->where('status', 0)->count();
                                                ?>
                                                <span class="info-box-icon bg-{{$color}}">
{{--                                                    <a href="{{route($route)}}}">--}}
                                                        <i class="fa fa-user"></i>
                                                    {{--</a>--}}
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text"><h4>{{$type."s: ".$countAdmin}}</h4></span>
                                                    <span class="info-box-number">Active: {{$countAdminActive}} &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; Non-Active: {{$countAdminNonActive}}</span>
                                                </div><!-- /.info-box-content -->
                                            </div><!-- /.info-box -->
                                        {{--</center>--}}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box box-default box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Classes</b> Summary</h3>
                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="info-box">
                        <!-- Apply any bg-* class to to the icon to color it -->
                        <span class="info-box-icon bg-light-grey"><i class="fa fa-university"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><h4>TOTAL CLASSES</h4></span>
                            <span class="info-box-number">{{$classrooms->count()}}</span>
                        </div>
                    </div>
                    {{--<table class="table table-hover">--}}
                        {{--<thead>--}}
                            {{--<tr>--}}
                                {{--@foreach($getUniqueCS as $c_subject)--}}
                                    {{--@for($i = 1; $i <=5; $i++)--}}
                                        {{--<th>--}}
                                            {{--<div class="info-box">--}}
                                                {{--<span class="info-box-icon bg-grey">--}}
    {{--                                                    <a href="{{route($route)}}}">--}}
                                                    {{--<i class="fa fa-book"></i>--}}
                                                    {{--</a>--}}
                                                    {{--</span>--}}
                                                {{--<div class="info-box-content">--}}
                                                    {{--<span class="info-box-text"><h4>{{$type."s: ".$countAdmin}}</h4></span>--}}
                                                    {{--<span class="info-box-number">Active: {{$countAdminActive}} &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; Non-Active: {{$countAdminNonActive}}</span>--}}
                                                {{--</div><!-- /.info-box-content -->--}}
                                            {{--</div><!-- /.info-box -->--}}
                                        {{--</th>--}}
                                    {{--@endfor--}}
                                {{--@endforeach--}}
                            {{--</tr>--}}
                        {{--</thead>--}}
                    {{--</table>--}}
                </div>
            </div>
            <div class="box box-default box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Assessments</b> Summary</h3>
                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="info-box">
                        <!-- Apply any bg-* class to to the icon to color it -->
                        <span class="info-box-icon bg-light-grey"><i class="fa fa-book"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><h4>TOTAL ASSESSMENTS</h4></span>
                            <span class="info-box-number">{{$assessments->count()}}</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
            </div>
            <div class="box box-default box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Subjects</b> Summary</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="info-box">
                        <!-- Apply any bg-* class to to the icon to color it -->
                        <span class="info-box-icon bg-light-grey"><i class="fa fa-book"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><h4>TOTAL SUBJECTS</h4></span>
                            <span class="info-box-number">{{$subjects->count()}}</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
            </div>
            <div class="box box-default box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Questions</b> Summary</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="info-box">
                        <!-- Apply any bg-* class to to the icon to color it -->
                        <span class="info-box-icon bg-light-grey"><i class="fa fa-book"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><h4>TOTAL QUESTIONS</h4></span>
                            <span class="info-box-number">{{$questions->count()}}</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        {{--<div class="box-footer">--}}
            {{--Footer--}}
        {{--</div>--}}
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->

@stop()