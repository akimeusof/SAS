@extends('layout.layoutMasterAdmin')
@section('layout')
    @if(Auth::check())
        @if(Auth::user() ->type=='admin')
            <?php
                $user = Auth::user();
                $subjects = App\Subject::all()->where('status', 1)->sortBy('name');
            ?>
            <div class="wrapper">

                <header class="main-header">
                    <!-- Logo -->
                    <a href="{{route('admin.index')}}" class="logo">
                        <!-- logo for regular state and mobile devices -->
                        <span class="logo-lg"><b>Admin</b>SAS</span>
                    </a>
                    <!-- Header Navbar: style can be found in header.less -->
                    <nav class="navbar navbar-static-top">
                        <!-- Sidebar toggle button-->
                        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                            <span class="sr-only">Toggle navigation</span>
                        </a>

                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                                <!-- User Account: style can be found in dropdown.less -->
                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="/uploads/avatar/{{$user->adminprofile->avatar}}" class="user-image" alt="User Image">
                                        <span class="hidden-xs">{{$user->username}}</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- User image -->
                                        <li class="user-header">
                                            <img src="/uploads/avatar/{{$user->adminprofile->avatar}}">

                                            <p>
                                                {{$user->adminprofile->name}}
                                                <small>{{$user->adminprofile->id}}</small>
                                            </p>
                                        </li>
                                        <!-- Menu Footer-->
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="{{ url('/profileAdmin')  }}" class="btn btn-default btn-flat">Profile</a>
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
                <!-- Left side column. contains the logo and sidebar -->
                <aside class="main-sidebar">
                    <!-- sidebar: style can be found in sidebar.less -->
                    <section class="sidebar">
                        <!-- Sidebar user panel -->
                    {{--<div class="user-panel">--}}
                    {{--<div class="pull-left image">--}}
                    {{--<img src="{{asset('uploads/avatar/default.jpg')}}" class="img-circle" alt="User Image">--}}
                    {{--<img src="/uploads/avatar/{{$user->lecturerprofile->avatar}}" class="img-circle" alt="User Image" title="Go to Profile">--}}
                    {{--</div>--}}
                    {{--<div class="pull-left info">--}}
                    {{--<p>{{Auth::user()->username}}</p>--}}
                    {{--make this to a link to profile--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                        <ul class="sidebar-menu">
                            <li class="header">MAIN NAVIGATION</li>
                            <li class="treeview">
                                <a href="{{route('admin.index')}}">
                                    <i class="fa fa-circle-o"></i> <span>Home Page</span>
                                </a>

                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-circle-o"></i> <span>Users</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <a href="{{ url('/newAdmin') }}"><i class="fa fa-circle"></i> Admin</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-circle"></i> Lecturer<i class="fa fa-angle-left pull-right"></i></a>
                                        <ul class="treeview-menu">
                                            <li><a href="{{ url('/newLecturer') }}"><i class="fa fa-circle-o"></i> Add New</a></li>
                                            <li>
                                                <a href="{{ url('/lecturers') }}"><i class="fa fa-circle-o"></i> View All</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="#"><i class="fa fa-circle"></i> Student<i class="fa fa-angle-left pull-right"></i></a>
                                        <ul class="treeview-menu">
                                            <li><a href="{{ url('/newStudent') }}"><i class="fa fa-circle-o"></i> Add New</a></li>
                                            <li>
                                                <a href="{{ url('/students') }}"><i class="fa fa-circle-o"></i> View All</a>
                                            </li>
                                        </ul></li>

                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="{{url('/subjects')}}">
                                    <i class="fa fa-circle-o"></i> <span>Subjects</span>
                                </a>
                            </li>
                            <li class="treeview">
                                <a href="{{route('semesters')}}">
                                    <i class="fa fa-circle-o"></i> <span>Semesters</span>
                                </a>
                            </li>
                            <li class="treeview">
                                <a href="{{route('programmes')}}">
                                    <i class="fa fa-circle-o"></i> <span>Programmes</span>
                                </a>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-circle-o"></i> <span>Classes</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="treeview">
                                        <a href="{{url('/newClass')}}">
                                            <i class="fa fa-circle"></i> <span>Create New Class</span>
                                        </a>
                                    </li>
                                    <li class="treeview">
                                        <a href="{{url('/classes')}}">
                                            <i class="fa fa-circle"></i> <span>View All Classes</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="{{route('viewAllQuestions')}}">
                                    <i class="fa fa-circle-o"></i> <span>Questions</span>
                                </a>
                            </li>

                            {{--<li class="treeview">--}}
                                {{--<a href="#">--}}
                                    {{--<i class="fa fa-industry"></i> <span>Question Bank</span>--}}
                                    {{--<i class="fa fa-angle-left pull-right"></i>--}}
                                {{--</a>--}}
                                {{--<ul class="treeview-menu">--}}
                                    {{--<li><a href="{{ route('questionOperation.create') }}"><i class="fa fa-circle"></i> Insert New Question</a></li>--}}
                                    {{--<li><a href="{{route('lecturerViewAllQuestions')}}"><i class="fa fa-circle"></i> View All Questions</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                        </ul>
                    </section>
                    <!-- /.sidebar -->
                </aside>

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
                    {{--<strong>Copyright &copy; 2016-2017 <a href="#">Muhamad Zubair Md Eusof</a>.</strong> All rights--}}
                    {{--reserved.--}}
                {{--</footer>--}}

            </div>
            <!-- ./wrapper -->
        @else
            Unauthorized Access.
        @endif
    @endif

@stop()