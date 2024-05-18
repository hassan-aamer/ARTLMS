<header class="header-style-1">
    <div class="header-topbar topbar-style-2">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-7 col-lg-6 col-md-12">
                    <div
                        class="header-contact text-center text-lg-start d-none d-sm-block"
                    >
                        <ul class="list-inline">
                            <li class="list-inline-item">
                    <span class="text-color me-2"
                    ><i class="fa fa-envelope"></i></span
                    ><a href="malito:mohamednaser@spcd.psu.edu.eg"
                                >mohamednaser@spcd.psu.edu.eg</a
                                >
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-5 col-lg-6 col-md-12">
                    <div
                        class="d-sm-flex justify-content-center justify-content-lg-end"
                    >

                        @if(!Auth::check())
                        <div class="header-socials text-center text-lg-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a
                                        class="btn btn-main px-4 py-1 fs-12 text-white rounded-2"
                                        href="{{route('website.teacher.register_page')}}"
                                    >
                                        <i class="fa fa-graduation-cap me-1"></i>
                                        انضم إلينا كمحاضر
                                    </a>
                                </li>
                            </ul>
                        </div>
                        @endif

                        <div class="header-btn text-center text-lg-end">

                            @if(!Auth::check())
                            <a href="{{route('website.student.login_page')}}"> <i class="fa fa-lock-alt"></i>دخول</a>
                            <a class="ms-2" href="{{route('website.student.register_page')}}"><i class="fa fa-user-alt"></i>تسجيل</a>
                            @else
                            <div class="dropdown">
                              <a
                                class="nav-link"
                                href="#"
                                id="navbarDarkDropdownMenuLink"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                              >
                                <img
                                  src="{{assetURLFile(Auth::user()->userInfo?->image)}}"
                                  width="20"
                                  height="20"
                                  alt="user"
                                  onerror="this.src='{{asset('frontend/assets/images/clients/testimonial-avata-01.jpg')}}'"
                                />
                                <span class="name ms-2"> {{Auth::user()->name}} </span>
                              </a>
                              <ul
                                class="dropdown-menu"
                                aria-labelledby="navbarDarkDropdownMenuLink"
                              >
                                  @if(auth()->user()->type == 'student')

                                      <li>
                                          <a class="dropdown-item text-dark fs-14" href="{{route('website.student.dashboard')}}">
                                              <i class="fa fa-user"></i>
                                              ملفى الشخصى</a
                                          >
                                      </li>

                                      <li>
                                          <a class="dropdown-item text-dark fs-14" href="{{route('website.courses.myFavorite')}}">
                                              <i class="fa fa-book-reader"></i>
                                              أنشطتى</a
                                          >
                                      </li>

                                      <li>
                                          <a class="dropdown-item text-dark fs-14" href="{{route('website.student.calendars')}}">
                                              <i class="fa fa-video"></i>
                                              تقويماتي</a
                                          >
                                      </li>

                                      <li>
                                          <a class="dropdown-item text-dark fs-14" href="{{route('website.student.appointments')}}">
                                              <i class="fa fa-handshake"></i>
                                              اجتماعاتي</a
                                          >
                                      </li>

                                  @endif
                                <li>
                                  <a class="dropdown-item text-dark fs-14" href="{{ route('student_logout') }}"
                                     onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i>
                                    تسجيل الخروج</a
                                  >
                                    <form id="logout-form" action="{{ route('student_logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                              </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-navbar navbar-sticky">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <div class="site-logo">
                    <a class="d-flex" href="{{route('website.index')}}">
                        <img width="100" style="height: 70px !important;" src="{{ asset('frontend/assets/images/logo-v3.png')}}" alt="art" />
                        <span class="mx-1"></span>
                        <img width="50" src="{{ asset('frontend/assets/images/fan-logo.jpg')}}" alt="" class="me-2" />
                    </a>
                </div>

                <div class="offcanvas-icon d-block d-lg-none">
                    <a href="#" class="nav-toggler"><i class="fal fa-bars"></i></a>
                </div>

                <div class="header-category-menu d-none d-xl-block">
                    <ul>
                        <li class="has-submenu">
                            <a href="javascript:void(0);"
                            ><i class="fa fa-th me-2"></i>المزيد</a
                            >
                            <ul class="submenu">

                                <li>
                                    <a class="fs-13 d-flex" href="{{route('website.skills.index')}}">
                                        <i
                                            class="far fa-angle-double-left relative-t-2 me-1"
                                        ></i>
                                        المهارات
                                    </a>
                                </li>
                                <li class="my-0 d-xl-block d-none">
                                    <hr />
                                </li>

                                <li>
                                    <a class="fs-13 d-flex" href="{{ route('website.meetings.index') }}">
                                        <i
                                            class="far fa-angle-double-left relative-t-2 me-1"
                                        ></i>
                                        الفصول الافتراضية
                                    </a>
                                </li>
                                <li class="my-0 d-xl-block d-none">
                                    <hr />
                                </li>
                                <li>
                                    <a class="fs-13 d-flex" href="{{ route('website.galleries.index') }}">
                                        <i
                                            class="far fa-angle-double-left relative-t-2 me-1"
                                        ></i>
                                        المعارض الفنية
                                    </a>
                                </li>
                                <li class="my-0 d-xl-block d-none">
                                    <hr />
                                </li>
                                <li>
                                    <a class="fs-13 d-flex" href="{{ route('website.tools.index') }}">
                                        <i
                                            class="far fa-angle-double-left relative-t-2 me-1"
                                        ></i>
                                        الأدوات الدراسية
                                    </a>
                                </li>
                                <li class="my-0 d-xl-block d-none">
                                    <hr />
                                </li>

                                <li>
                                    <a class="fs-13 d-flex" href="{{ route('website.guides.index') }}">
                                        <i
                                            class="far fa-angle-double-left relative-t-2 me-1"
                                        ></i>
                                        دليل المستخدم
                                    </a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="header-search-bar d-none d-xl-block ms-4">
                    <form method="post" id="searchForm">
                        @csrf
                        <input
                            type="text"
                            class="form-control fs-14"
                            style="min-width: 250px"
                            name="search"
                            id="search"
                            placeholder="ابحث عن نشاط"
                            required
                        />
                        <button  type="submit" class="search-submit"><i class="far fa-search"></i></button>
                    </form>
                </div>


                <nav class="site-navbar mr-auto">
                    <ul class="primary-menu">

                        <li class="current">
                            <a href="{{route('website.index')}}">الرئيسية</a>
                        </li>
                        <li>
                            <a href="#">مناهجي</a>
                            <ul class="submenu">
                                <li>
                                    <a href="{{route('website.categories.index')}}" class="fs-14 d-flex">
                                        <i
                                            class="far fa-angle-double-left relative-t-2 me-1"
                                        ></i>
                                        المجالات و المحاور الفنية
                                    </a>
                                </li>
                                <li class="my-0 d-xl-block d-none">
                                    <hr />
                                </li>
                                <li>
                                    <a class="fs-13 d-flex" href="{{route('website.curriculums.index')}}">
                                        <i
                                            class="far fa-angle-double-left relative-t-2 me-1"
                                        ></i>
                                        عرض كل المناهج
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{route('website.teachers.index')}}">المحاضرون والمعلمون</a>
                        </li>
                        <li>
                            <a href="{{route('website.articles.index')}}">المدونة</a>
                        </li>
                        <li>
                            <a href="{{route('website.contacts')}}">تواصل معنا</a>
                        </li>

                        <li class="d-lg-none">
                            <a href="{{ route('website.meetings.index') }}">   الفصول الافتراضية</a>
                        </li>
                        <li class="d-lg-none">
                            <a href="{{ route('website.galleries.index') }}">     المعارض الفنية</a>
                        </li>
                        <li class="d-lg-none">
                            <a href="{{ route('website.tools.index') }}">   الأدوات الدراسية</a>
                        </li>
                        <li class="d-lg-none">
                            <a href="{{ route('website.skills.index') }}">    المهارات</a>
                        </li>

                    </ul>

                    <a href="#" class="nav-close"><i class="fal fa-times"></i></a>
                </nav>
            </div>
        </div>
    </div>
</header>
@if(\Auth::check() && auth()->user()->userInfo?->level_id)
    @php
        $level =  \App\Models\Level::find(auth()->user()->userInfo?->level_id);
    @endphp
    @if($level?->hyper_link)
        <div class="w-100 py-1 bg-warning text-white text-center">
            <a href="{{$level?->hyper_link}}" class="text-white text-decoration-underline fw-bold" target="_blank">رابط استمارة الرغبات</a>
        </div>
    @endif
@endif
