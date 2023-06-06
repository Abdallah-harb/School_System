<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{trans('main_sidbar.Dashboard')}}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="dashboard" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('dashboard')}}">{{trans('main_sidbar.mainpage')}}</a> </li>
                        </ul>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_sidbar.Components')}} </li>
                    <!-- menu item Elements-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{trans('main_sidbar.Grade')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('grade.index')}}">{{trans('main_sidbar.Grade_list')}}</a></li>
                        </ul>
                    </li>
                    <!-- menu item calendar-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                            <div class="pull-left"><i class="ti-calendar"></i><span
                                    class="right-nav-text">{{trans('main_sidbar.Classrooms')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('classroom.index')}}">{{trans('main_sidbar.Classrooms_list')}} </a> </li>

                        </ul>
                    </li>
                    <!-- menu item Charts-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#chart">
                            <div class="pull-left"><i class="ti-pie-chart"></i><span
                                    class="right-nav-text">{{trans('Sections_trans.title_page')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="chart" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('section.index')}}">{{trans('Sections_trans.List_Section')}}</a> </li>

                        </ul>
                    </li>

                    <!-- menu item Students-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu"><i class="fa fa-user"></i>{{trans('Students_trans.students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                            <ul id="students-menu" class="collapse">
                                <li>
                                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Student_information">{{trans('Students_trans.Student_information')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                                    <ul id="Student_information" class="collapse">
                                        <li> <a href="{{route('students.create')}}">{{trans('Students_trans.Add_student')}}</a></li>
                                        <li> <a href="{{route('students.index')}}">{{trans('Students_trans.All_students')}}</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Students_upgrade">{{trans('Students_trans.student_promotion')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                                    <ul id="Students_upgrade" class="collapse">
                                        <li> <a href="{{route('promotion.index')}}">{{trans('Students_trans.student_promotion')}}</a></li>
                                        <li> <a href="{{route('promotion.create')}}">{{trans('Students_trans.promotion_management')}}</a> </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Graduate students">{{trans('Students_trans.Graduate_students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                                    <ul id="Graduate students" class="collapse">
                                        <li> <a href="{{route('graduations.create')}}">{{trans('Students_trans.add_Graduate')}}</a> </li>
                                        <li> <a href="{{route('graduations.index')}}">{{trans('Students_trans.list_Graduate')}}</a> </li>
                                    </ul>
                                </li>
                            </ul>

                    </li>

                    <!-- students-->


                    <!-- Teachers -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#teaches">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{trans('Teacher_trans.teachers')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="teaches" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('teachers.index')}}">{{trans('Teacher_trans.teachers_list')}}</a></li>

                        </ul>
                    </li>

                    <!-- parents -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#parents">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{trans('Parent_trans.parent')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="parents" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('parents')}}">{{trans('Parent_trans.parent_list')}}</a></li>
                        </ul>
                    </li>



                    <!-- the Fees -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#accounts">
                            <div class="pull-left"><i class="fa fa-money"></i><span
                                    class="right-nav-text">{{trans('accounts.accounts')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="accounts" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('fees.index')}}">{{trans('accounts.study_fees')}}</a></li>
                            <li><a href="{{route('fees_invoice.index')}}">{{trans('accounts.study_account')}}</a></li>
                            <li><a href="{{route('processing_fees.index')}}">{{trans('accounts.Fees_excluded')}}</a></li>
                            <li><a href="{{route('PaymentStudent.index')}}">{{trans('accounts.payment_student')}}</a></li>
                        </ul>
                    </li>



                    <!-- menu item attendance-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#attendance">
                            <div class="pull-left"><i class="fa fa-clipboard"></i><span
                                    class="right-nav-text">{{trans('Attendance.attendance')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="attendance" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('attendance.index')}}">{{trans('Attendance.student_list')}}</a> </li>
                        </ul>
                    </li>

                    <!-- menu item subjects-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#subjects">
                            <div class="pull-left"><i class="fa fa-book"></i><span
                                    class="right-nav-text">{{trans('Subjects.Subjects')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="subjects" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('subjects.index')}}">{{trans('Subjects.Subjects_list')}}</a> </li>
                        </ul>
                    </li>

                    <!-- menu Library-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Library">
                            <div class="pull-left"><i class="fa fa-book"></i><span
                                    class="right-nav-text">المكتبه</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Library" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('library.index')}}">جميع الكتب</a> </li>
                        </ul>
                    </li>

                    <!-- menu item quize-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams">
                            <div class="pull-left"><i class="fa fa-book"></i><span
                                    class="right-nav-text">{{trans('Exams.exams')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Exams" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('quiz.index')}}">{{trans('Exams.exams_list')}}</a> </li>
                            <li> <a href="{{route('question.index')}}">{{trans('Exams.questions')}}</a> </li>
                        </ul>
                    </li>


                    <!-- start Online classes -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#classes">
                            <div class="pull-left"><i class="fa fa-book"></i><span
                                    class="right-nav-text">{{trans('Zoom.Online_classes')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="classes" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('online_classes.index')}}">{{trans('Zoom.integration_Direct_With_Zoom')}}</a> </li>
                            <li> <a href="{{route('online_classes.index')}}">{{trans('Zoom.integration_inDirect_With_Zoom')}}</a> </li>
                        </ul>
                    </li>


                    <!-- menu item Form-->


                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">More Pages</li>

                    <!-- menu item Authentication-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#authentication">
                            <div class="pull-left"><i class="ti-id-badge"></i><span
                                    class="right-nav-text">Authentication</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="authentication" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="login.html">login</a> </li>
                            <li> <a href="register.html">register</a> </li>
                            <li> <a href="lockscreen.html">Lock screen</a> </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
