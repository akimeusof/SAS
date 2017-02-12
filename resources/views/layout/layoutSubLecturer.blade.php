@extends('layout.layoutMasterLecturer')
@section('layout')
    @if(Auth::check())
        @if(Auth::user()->type=='lecturer')
            <?php
            $user = Auth::user();
            $subjects = App\Subject::all()->where('status', 1)->sortBy('name');
            ?>
            <!-- Site wrapper -->
            <div class="wrapper">
                <header class="main-header">
                    <!-- Logo -->
                    <a href="{{route('lecturer.index')}}" class="logo">
                        <!-- logo for regular state and mobile devices -->
                        <span class="logo-lg"><b>Lecturer</b>SAS</span>
                    </a>
                    <!-- Header Navbar: style can be found in header.less -->
                    <nav class="navbar navbar-static-top">
                        <!-- Sidebar toggle button-->
                        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" title="Hide Side Bar">
                            <span class="sr-only">Toggle navigation</span>
                        </a>

                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                                <!-- User Account: style can be found in dropdown.less -->
                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="/uploads/avatar/{{$user->lecturerprofile->avatar}}" class="user-image" alt="User Image">
                                        <span class="hidden-xs">{{$user->username}}</span>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <!-- User image -->
                                        <li class="user-header">
                                            <img src="/uploads/avatar/{{$user->lecturerprofile->avatar}}">

                                            <p>
                                                {{$user->lecturerprofile->name}}
                                                <small>{{$user->lecturerprofile->id}}</small>
                                            </p>
                                        </li>
                                        <!-- Menu Footer-->
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="{{ url('/profileLecturer')  }}" class="btn btn-default btn-flat">Profile</a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="{{ url('/logout')  }}" class="btn btn-default btn-flat">Sign out</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        </div>
                    </nav>
                </header>


                <!-- =============================================== -->

                <!-- Left side column. contains the sidebar -->
                <aside class="main-sidebar">
                    <!-- sidebar: style can be found in sidebar.less -->
                    <section class="sidebar">
                        <!-- Sidebar user panel -->
                        <!-- sidebar menu: : style can be found in sidebar.less -->
                        <ul class="sidebar-menu">
                            <li class="header">MAIN NAVIGATION</li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-circle-o"></i> <span>Classes</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{url('/l_newClass')}}"><i class="fa fa-circle"></i> Create New Class</a></li>
                                    <li><a href="{{url('/l_classes')}}"><i class="fa fa-circle"></i> View All Classes</a></li>
                                </ul>
                            </li>
                            {{--<li class="treeview">--}}
                            {{--                    <a href="{{url('/l_classes')}}">--}}
                            {{--<i class="fa fa-university"></i> <span>Classes</span>--}}
                            {{--</a>--}}
                            {{--</li>--}}
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-circle-o"></i> <span>Assessments</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{url('/l_newAssessment')}}"><i class="fa fa-circle"></i> Create New Assessment</a></li>
                                    <li><a href="{{url('/l_assessments')}}"><i class="fa fa-circle"></i> View All Assessments</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-circle-o"></i> <span>Question Bank</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{ route('lecturerQuestionOperation.create') }}"><i class="fa fa-circle"></i> Insert New Question</a></li>
                                    <li><a href="{{route('lecturerViewAllQuestions')}}"><i class="fa fa-circle"></i> View All Public Questions</a></li>

                                    {{--<li>--}}
                                    {{--<a href="#"><i class="fa fa-circle"></i> Add New Question <i class="fa fa-angle-left pull-right"></i></a>--}}
                                    {{--<ul class="treeview-menu">--}}
                                    {{--@foreach($subjects as $subject)--}}
                                    {{--<li><a href="{{route('lecturerQuestionOperation.show', $subject->subject_id) }}"><i class="fa fa-circle-o"></i> {{$subject->name}}</a></li>--}}
                                    {{--@endforeach--}}
                                    {{--</ul>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                    {{--<a href="#"><i class="fa fa-circle"></i> View Questions <i class="fa fa-angle-left pull-right"></i></a>--}}
                                    {{--<ul class="treeview-menu">--}}
                                    {{--@foreach($subjects as $subject)--}}
                                    {{--<li><a href="#"><i class="fa fa-circle-o"></i> {{$subject->name}}</a></li>--}}
                                    {{--@endforeach--}}
                                    {{--<li><a href="{{route('lecturerViewAllQuestions')}}"><i class="fa fa-circle-o"></i> View All Questions</a></li>--}}

                                    {{--</ul>--}}
                                    {{--</li>--}}
                                </ul>
                            </li>
                        </ul>
                    </section>
                    <!-- /.sidebar -->
                </aside>

                <!-- =============================================== -->

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        @yield('content')
                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->

                {{--<footer class="main-footer">--}}
                    {{--<div class="pull-right hidden-xs">--}}
                    {{--<b>Version</b> 2.3.3--}}
                    {{--</div>--}}
                    {{--<strong>Copyright &copy; 2016-2017 <a href="#">Zubair Inc</a>.</strong> All rights--}}
                    {{--reserved.--}}
                {{--</footer>--}}

                {{--<div class="control-sidebar-bg"></div>--}}
            </div>
            <!-- ./wrapper -->

        @else
            Unauthorized Access.
        @endif
    @endif

@stop()