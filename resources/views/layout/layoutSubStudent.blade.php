@extends('layout.layoutMasterStudent')
@section('layout')
    @if(Auth::check())
        @if(Auth::user()->type=='student')
            <?php
                $user = Auth::user();
                $subjects = App\Subject::all()->where('status', 1)->sortBy('name');
            ?>
            <!-- Site wrapper -->
            <div class="wrapper">
                <header class="main-header">
                    <!-- Logo -->
                    <a href="{{route('student.index')}}" class="logo">
                        <!-- logo for regular state and mobile devices -->
                        <span class="logo-lg"><b>Student</b>SAS</span>
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
                                        <img src="/uploads/avatar/{{$user->studentprofile->avatar}}" class="user-image" alt="User Image">
                                        <span class="hidden-xs">{{$user->username}}</span>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <!-- User image -->
                                        <li class="user-header">
                                            <img src="/uploads/avatar/{{$user->studentprofile->avatar}}">

                                            <p>
                                                {{$user->studentprofile->name}}
                                                <small>{{$user->studentprofile->id}}</small>
                                            </p>
                                        </li>
                                        <!-- Menu Footer-->
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="{{ url('/profileStudent')  }}" class="btn btn-default btn-flat">Profile</a>
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
                                <a href="{{route('student.index')}}">
                                    <i class="fa fa-circle-o"></i> <span>Homepage</span>
                                </a>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-circle-o"></i> <span>Classes</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{route('s_viewEnrolledClassroom')}}"><i class="fa fa-circle"></i> View Enrolled Classes</a></li>
                                    <li><a href="{{route('s_viewAllClassroom')}}"><i class="fa fa-circle"></i> View All Classes</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="{{route('s_viewAllAssessment')}}">
                                    <i class="fa fa-circle-o"></i> <span>Assessments</span>
                                </a>
                            </li>
{{--                            <li><a href="{{route('s_viewAllAssessment')}}"><i class="fa fa-university"></i> Assessments</a></li>--}}
{{--                            <li><a href="{{route('s_test', \Auth::user()->id)}}"><i class="fa fa-university"></i> test je</a></li>--}}
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