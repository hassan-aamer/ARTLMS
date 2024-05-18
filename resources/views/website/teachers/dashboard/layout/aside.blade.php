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
        <li>
            <a href="{{ route('extensions.index')  }}">
                <div class="parent-icon"><i class="lni lni-files"></i>
                </div>
                <div class="menu-title"> أنواع الملفات </div>
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
                <div class="menu-title"> المهارات </div>
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
                <div class="menu-title"> المقرر </div>
            </a>
        </li>

        <li>
            <a href="{{ route('units.index')  }}">
                <div class="parent-icon"><i class="lni lni-text-align-right"></i>
                </div>
                <div class="menu-title"> الوحدات </div>
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








    </ul>
    <!--end navigation-->
</aside>
<!--end sidebar -->
