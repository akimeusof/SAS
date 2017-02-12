@extends('layout.layoutMasterLecturer')
@section('layout')
    @if(Auth::check())
        @if(Auth::user() ->type=='lecturer')
            <!-- Site wrapper -->
            <div class="wrapper">

                <header class="main-header">
                    <!-- Logo -->
                    <a href="{{route('lecturer.index')}}" class="logo">
                        <!-- mini logo for sidebar mini 50x50 pixels -->
                    {{--<span class="logo-mini"><b>SAS</b></span>--}}
                    <!-- logo for regular state and mobile devices -->
                        <span class="logo-lg"><b>SAS</b>Lecturer</span>
                    </a>
                    <!-- Header Navbar: style can be found in header.less -->
                    <nav class="navbar navbar-static-top">
                        <!-- Sidebar toggle button-->
                        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>

                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                                <!-- Messages: style can be found in dropdown.less-->

                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="{{ asset('uploads/avatar/default.jpg')}}" class="user-image" alt="User Image">
                                        <span class="hidden-xs">{{ Auth::user()->username }}</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- User image -->
                                        <li class="user-header">
                                            <img src="{{ asset('uploads/avatar/default.jpg')}}" class="img-circle" alt="User Image">

                                            <p>
                                                {{ Auth::user()->name }}<br>
                                                {{ Auth::user()->id }}<br>
                                                <small>Member since Nov. 2012</small>
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
                        <div class="user-panel">
                            <div class="pull-left image">
                                <img src="{{asset('uploads/avatar/default.jpg')}}" class="img-circle" alt="User Image">
                            </div>
                            <div class="pull-left info">
                                <p>{{ Auth::user()->username }}</p>
                                <a href="#"><i class=""></i> Lecturer</a>
                            </div>
                        </div>
                        <!-- sidebar menu: : style can be found in sidebar.less -->
                        <ul class="sidebar-menu">
                            <li class="header">MAIN NAVIGATION</li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                                    <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="{{url('/l_classes')}}">
                                    <i class="fa fa-users"></i> <span>Classes</span>
                                </a>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-share"></i> <span>Assessments</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{url('/l_newAssessment')}}"><i class="fa fa-circle-o"></i> Create New Assessment</a></li>
                                    <li><a href="{{url('/l_assessments')}}"><i class="fa fa-circle-o"></i> View All Assessments</a></li>
                                    <li>
                                        <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                                        <ul class="treeview-menu">
                                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                                            <li>
                                                <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                                                <ul class="treeview-menu">
                                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                                </ul>
                            </li>

                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-share"></i> <span>Subjects/Maybe remove</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Add New Subject</a></li>
                                    <li><a href="{{url('/l_subjects')}}"><i class="fa fa-circle-o"></i> View All Subjects</a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
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

                <footer class="main-footer">
                    <div class="pull-right hidden-xs">
                        <b>Version</b> 2.3.3
                    </div>
                    <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
                    reserved.
                </footer>
            </div>
            <!-- ./wrapper -->

        @else
            something.
        @endif
    @endif

@stop()