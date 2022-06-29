@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();

@endphp

<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="index.html">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{asset('backend/assets/images/logo-dark.png')}}" alt="">
                        <h3><b>Sunny</b> Admin</h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="{{$route=='dashboard'?'active':''}}">
                <a href="{{route('dashboard')}}">
                    <i data-feather="pie-chart"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            @if(Auth::user()->role=='Admin')
            <li class="treeview {{$prefix=='/users'?'active':''}}">
                <a href="#">
                    <i data-feather="user"></i>
                    <span>Manage Users</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{$route=='view.users'?'active':''}}"><a href="{{route('view.users')}}"><i class="ti-more"></i>All Users</a></li>
                    <li class="{{$route=='add.user'?'active':''}}"><a href="{{route('add.user')}}"><i class="ti-more"></i>Add User</a></li>
                </ul>
            </li>
            @endif

            <li class="treeview {{$prefix=='/admin'?'active':''}}">
                <a href="#">
                    <i data-feather="user"></i>
                    <span>Manage Profile</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{$route=='profile.page'?'active':''}}"><a href="{{route('profile.page')}}"><i class="ti-more"></i>View Profile</a></li>

                </ul>
            </li>
            <li class="treeview {{$prefix=='/setups'?'active':''}}">
                <a href="#">
                    <i data-feather="user"></i>
                    <span>Setup Management</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{$route=='view.student.class'?'active':''}}"><a href="{{route('view.student.class')}}"><i class="ti-more"></i>Student Class</a></li>
                    <li class="{{$route=='student.year.page'?'active':''}}"><a href="{{route('student.year.page')}}"><i class="ti-more"></i>Student Year</a></li>
                    <li class="{{$route=='view.student.group'?'active':''}}"><a href="{{route('view.student.group')}}"><i class="ti-more"></i>Student Group</a></li>
                    <li class="{{$route=='view.student.shift'?'active':''}}"><a href="{{route('view.student.shift')}}"><i class="ti-more"></i>Student Shift</a></li>
                    <li class="{{$route=='view.fee.category'?'active':''}}"><a href="{{route('view.fee.category')}}"><i class="ti-more"></i>Fee Category</a></li>
                    <li class="{{$route=='view.fee.amount'?'active':''}}"><a href="{{route('view.fee.amount')}}"><i class="ti-more"></i>Fee Category Amount</a></li>
                    <li class="{{$route=='view.exam.type'?'active':''}}"><a href="{{route('view.exam.type')}}"><i class="ti-more"></i>Exam Type</a></li>
                    <li class="{{$route=='view.subject'?'active':''}}"><a href="{{route('view.subject')}}"><i class="ti-more"></i>Student Subject</a></li>
                    <li class="{{$route=='view.assign.subject'?'active':''}}"><a href="{{route('view.assign.subject')}}"><i class="ti-more"></i>Assign Subject</a></li>
                    <li class="{{$route=='view.designations'?'active':''}}"><a href="{{route('view.designations')}}"><i class="ti-more"></i>Designation</a></li>

                </ul>
            </li>
            <li class="treeview {{$prefix=='/students'?'active':''}}">
                <a href="#">
                    <i data-feather="user"></i>
                    <span>Students Management</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{$route=='view.students'?'active':''}}"><a href="{{route('view.students')}}"><i class="ti-more"></i>All Students</a></li>
                    <li class="{{$route=='roll.generate.view'?'active':''}}"><a href="{{route('roll.generate.view')}}"><i class="ti-more"></i>Roll Generate</a></li>
                    <li class="{{$route=='student.reg.fee.page'?'active':''}}"><a href="{{route('student.reg.fee.page')}}"><i class="ti-more"></i>Registration Fee</a></li>
                    <li class="{{$route=='monthly.fee.view'?'active':''}}"><a href="{{route('monthly.fee.view')}}"><i class="ti-more"></i>Monthly Fee</a></li>
                    <li class="{{$route=='exam.fee.option.view'?'active':''}}"><a href="{{route('exam.fee.option.view')}}"><i class="ti-more"></i>Exam Fee Option</a></li>
                </ul>
            </li>

            <li class="treeview {{$prefix=='/employees'?'active':''}}">
                <a href="#">
                    <i data-feather="user"></i>
                    <span>Employee Management</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{$route=='view.employees'?'active':''}}"><a href="{{route('view.employees')}}"><i class="ti-more"></i>All Employees</a></li>
                    <li class="{{$route=='view.employees.salary'?'active':''}}"><a href="{{route('view.employees.salary')}}"><i class="ti-more"></i>Manage Salary</a></li>
                    <li class="{{$route=='view.employee.leave'?'active':''}}"><a href="{{route('view.employee.leave')}}"><i class="ti-more"></i>Employee Leave</a></li>
                    <li class="{{$route=='view.attendance.page'?'active':''}}"><a href="{{route('view.attendance.page')}}"><i class="ti-more"></i>Employee Attendance</a></li>
                    <li class="{{$route=='view.monthly.salary.page'?'active':''}}"><a href="{{route('view.monthly.salary.page')}}"><i class="ti-more"></i>Employee Monthly Salary</a></li>
                </ul>
            </li>
            <li class="treeview {{$prefix=='/marks'?'active':''}}">
                <a href="#">
                    <i data-feather="user"></i>
                    <span>Marks Management</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{$route=='student.marks.page'?'active':''}}"><a href="{{route('student.marks.page')}}"><i class="ti-more"></i>Student Marks</a></li>
                    <li class="{{$route=='student.marks.update'?'active':''}}"><a href="{{route('student.marks.update')}}"><i class="ti-more"></i>Update Student Marks</a></li>
                    <li class="{{$route=='view.grade.page'?'active':''}}"><a href="{{route('view.grade.page')}}"><i class="ti-more"></i>Student Grades</a></li>
                </ul>
            </li>
            <li class="treeview {{$prefix=='/accounts'?'active':''}}">
                <a href="#">
                    <i data-feather="user"></i>
                    <span>Account Management</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{$route=='view.student.fee'?'active':''}}"><a href="{{route('view.student.fee')}}"><i class="ti-more"></i>Student Fee</a></li>
                    <li class="{{$route=='view.employee.account.salary'?'active':''}}"><a href="{{route('view.employee.account.salary')}}"><i class="ti-more"></i>Employee Salary Payment</a></li>
                    <li class="{{$route=='view.other.cost.page'?'active':''}}"><a href="{{route('view.other.cost.page')}}"><i class="ti-more"></i>Other Cost</a></li>
                </ul>
            </li>


            <li class="header nav-small-cap">Reports Management</li>

            <li class="treeview {{$prefix=='/reports'?'active':''}}">
                <a href="#">
                    <i data-feather="grid"></i>
                    <span>Reports Management</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{$route=='view.profit.page'?'active':''}}"><a href="{{route('view.profit.page')}}"><i class="ti-more"></i>Yearly and Monthly Profit</a></li>
                    <li class="{{$route=='view.marks.generate.page'?'active':''}}"><a href="{{route('view.marks.generate.page')}}"><i class="ti-more"></i>Generate MarkSheet</a></li>
                    <li class="{{$route=='view.attendance.report.page'?'active':''}}"><a href="{{route('view.attendance.report.page')}}"><i class="ti-more"></i>Employee Attendance</a></li>
                    <li class="{{$route=='view.results.generate.page'?'active':''}}"><a href="{{route('view.results.generate.page')}}"><i class="ti-more"></i>Student Result</a></li>
                    <li class="{{$route=='generate.id.card.page'?'active':''}}"><a href="{{route('generate.id.card.page')}}"><i class="ti-more"></i>Student ID Generate</a></li>

                </ul>
            </li>



            <li>
                <a href="auth_login.html">
                    <i data-feather="lock"></i>
                    <span>Log Out</span>
                </a>
            </li>

        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
    </div>
</aside>
