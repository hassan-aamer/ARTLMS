<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">

        <div>
            <h4 class="logo-text">منصة فن</h4>
        </div>
        <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">


        @if(auth()->user()->type == 'admin')
            <li>
                <a href="{{ route('admin.dashboard')  }}">
                    <div class="parent-icon"><i class="bi bi-house-fill"></i>
                    </div>
                    <div class="menu-title">لوحة التحكم</div>
                </a>
            </li>

            <li>
                <a href="{{ route('contacts.index')  }}">
                    <div class="parent-icon"><i class="bi bi-file-code-fill"></i>
                    </div>
                    <div class="menu-title">  الرسائل </div>
                    @if(messages() > 0)
                        <span style="background: red;padding: 1px 6px;position: absolute;left: 15px;color: #fff;}">
                            {{ messages()}}
                        </span>
                    @endif
                </a>
            </li>


            <li>
                <a href="{{ route('students.index')  }}">
                    <div class="parent-icon"><i class="lni lni-users"></i>
                    </div>
                    <div class="menu-title"> المتعلمون  </div>
                </a>
            </li>
            <li>
                <a href="{{ route('teachers.index')  }}">
                    <div class="parent-icon"><i class="lni lni-consulting"></i>
                    </div>
                    <div class="menu-title"> المحاضرون و المعلمون </div>
                </a>
            </li>
            <li>
                <a href="{{route('meets.index')}}">
                    <div class="parent-icon"><i class="lni lni-google"></i>
                    </div>
                    <div class="menu-title"> اجتماعات المحاضرين و المعلمين </div>
                </a>
            </li>
        @else
            <li>
                <a href="{{ route('website.teacher.dashboard')  }}">
                    <div class="parent-icon"><i class="bi bi-house-fill"></i>
                    </div>
                    <div class="menu-title">لوحة التحكم</div>
                </a>
            </li>
            <li>
                <a href="{{route('students_files.index')}}">
                    <div class="parent-icon"><i class="bi bi-file-code-fill"></i>
                    </div>
                    <div class="menu-title"> ملفات الإجابات للمتعلمين</div>
                    @if(getStudentFilesAnswers() > 0)
                        <span class="countNumber">{{getStudentFilesAnswers()}}</span>
                    @endif
                </a>
            </li>

            <li>
                <a href="{{route('courses_questions.index')}}">
                    <div class="parent-icon"><i class="lni lni-library"></i>
                    </div>
                    <div class="menu-title"> أسألة المتعلمين </div>
                    @if(getQuestionsNotAnswered() > 0)
                        <span class="countNumber">{{getQuestionsNotAnswered()}}</span>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{route('meets.index')}}">
                    <div class="parent-icon"><i class="lni lni-google"></i>
                    </div>
                    <div class="menu-title"> الاجتماعات </div>
                </a>
            </li>

            <li>
                <hr />
            </li>
        @endif

        <li>
            <a href="{{ route('extensions.index')  }}">
                <div class="parent-icon"><i class="lni lni-files"></i>
                </div>
                <div class="menu-title"> أنواع الملفات </div>
            </a>
        </li>

        <li>
            <a href="{{ route('terms.index')  }}">
                <div class="parent-icon"><i class="lni lni-layout"></i>
                </div>
                <div class="menu-title">الفصول الدراسية</div>
            </a>
        </li>

        <li>
            <a href="{{ route('sections.index')  }}">
                <div class="parent-icon"><i class="lni lni-layout"></i>
                </div>
                <div class="menu-title"> الشعب الدراسية   </div>
            </a>
        </li>

        <li>
            <a href="{{ route('levels.index')  }}">
                <div class="parent-icon"><i class="lni lni-layout"></i>
                </div>
                <div class="menu-title"> الصفوف الدراسية  </div>
            </a>
        </li>

        <li>
            <a href="{{ route('categories.index')  }}">
                <div class="parent-icon"><i class="bi bi-grid-fill"></i>
                </div>
                <div class="menu-title"> المجالات والمحاور الفنية </div>
            </a>
        </li>
        <li>
            <a href="{{ route('skills.index')  }}">
                <div class="parent-icon"><i class="bx bx-trophy"></i>
                </div>
                <div class="menu-title"> المهارات المتوقعة </div>
            </a>
        </li>

        <li>
            <a href="{{ route('curriculums.index')  }}">
                <div class="parent-icon"><i class="lni lni-book"></i>
                </div>
                <div class="menu-title"> المناهج </div>
            </a>
        </li>

        <li>
            <a href="{{ route('scheduleds.index')  }}">
                <div class="parent-icon"><i class="lni lni-trello"></i>
                </div>
                <div class="menu-title"> المقررات الدراسية </div>
            </a>
        </li>

        <li>
            <a href="{{ route('units.index')  }}">
                <div class="parent-icon"><i class="lni lni-text-align-right"></i>
                </div>
                <div class="menu-title"> الوحدات الدراسية </div>
            </a>
        </li>

        <li>
            <a href="{{ route('lessons.index')  }}">
                <div class="parent-icon"><i class="lni lni-library"></i>
                </div>
                <div class="menu-title"> الدروس/المحاضرات </div>
            </a>
        </li>



        <li>
            <a href="{{ route('courses.index')  }}">
                <div class="parent-icon"><i class="bi bi-file-code-fill"></i>
                </div>
                <div class="menu-title"> الأنشطة </div>
            </a>
        </li>


        <li>
            <a href="{{ route('calendars.index')  }}">
                <div class="parent-icon"><i class="bi bi-grid-fill"></i>
                </div>
                <div class="menu-title"> التقويمات </div>
            </a>
        </li>
        <li>
            <a href="{{ route('calendar_questions.index')  }}">
                <div class="parent-icon"><i class="bi bi-question-lg"></i>
                </div>
                <div class="menu-title"> أسئلة التقويمات </div>
            </a>
        </li>

        <li>
            <a href="{{ route('calendar_answers.index')  }}">
                <div class="parent-icon"><i class="bi bi-question-lg"></i>
                </div>
                <div class="menu-title"> إجابات التقويمات </div>
            </a>
        </li>



        <li>
            <a href="{{ route('tools.index')  }}">
                <div class="parent-icon"><i class="bi bi-file-code-fill"></i>
                </div>
                <div class="menu-title"> الأدوات الدراسية </div>
            </a>
        </li>

        <li>
            <a href="{{ route('galleries.index')  }}">
                <div class="parent-icon"><i class="bi bi-file-code-fill"></i>
                </div>
                <div class="menu-title">  المعارض الفنية </div>
            </a>
        </li>

        <li>
            <a href="{{ route('zooms.index')  }}">
                <div class="parent-icon"><i class="bi bi-file-code-fill"></i>
                </div>
                <div class="menu-title">   الفصول الافتراضية </div>
            </a>
        </li>

        <li class="dropdown-item dropdown">
            <a href="" onclick="return false" class="dropdown-item collapse" aria-expanded="false">
                <div class="parent-icon"><i class="lni lni-library"></i>
                </div>
                <div class="menu-title">     قسم المقالات <i class=" mx-4 bi bi-arrow-bar-down"></i> </div>

            </a>
            <ul>
                <li>
                    <a href="{{route('article_categories.index')}}">
                        <div class="parent-icon"><i class="lni lni-library"></i>
                        </div>
                        <div class="menu-title"> الأقسام</div>
                    </a>
                </li>
                <li>
                    <a href="{{route('article_tags.index')}}">
                        <div class="parent-icon"><i class="lni lni-library"></i>
                        </div>
                        <div class="menu-title"> التلميحات  </div>
                    </a>
                </li>
                <li>
                    <a href="{{route('articles.index')}}">
                        <div class="parent-icon"><i class="lni lni-library"></i>
                        </div>
                        <div class="menu-title"> المقالات</div>
                    </a>
                </li>
            </ul>
        </li>

            <li>
                <a href="{{ route('guides.index')  }}">
                    <div class="parent-icon"><i class="lni lni-trello"></i>
                    </div>
                    <div class="menu-title"> دليل المستخدم </div>
                </a>
            </li>

            <li>
                <a href="{{ route('settings.index')  }}">
                    <div class="parent-icon"><i class="lni lni-trello"></i>
                    </div>
                    <div class="menu-title">إعدادات الموقع  </div>
                </a>
            </li>








    </ul>
    <!--end navigation-->
</aside>
<!--end sidebar -->
