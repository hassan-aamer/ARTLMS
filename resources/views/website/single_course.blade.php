@extends('website.layout.master')

@section('page_title')   {{$page_title}}  @endsection
@section('content')

    @include('website.layout.inner-header')

    <section class="page-wrapper">
        <div class="tutori-course-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-xl-8 pe-lg-5">
                        <nav class="course-single-tabs learn-press-nav-tabs">
                            <div
                                class="nav nav-tabs course-nav"
                                id="nav-tab"
                                role="tablist"
                            >
                                <a
                                    class="nav-item nav-link active"
                                    id="nav-home-tab"
                                    data-bs-toggle="tab"
                                    href="#nav-home"
                                    role="tab"
                                    aria-controls="nav-home-tab"
                                    aria-selected="true"
                                >وصف النشاط</a
                                >
                                <a
                                    class="nav-item nav-link"
                                    id="nav-topics-tab"
                                    data-bs-toggle="tab"
                                    href="#nav-topics"
                                    role="tab"
                                    aria-controls="nav-topics-tab"
                                    aria-selected="false"
                                >تفاصيل النشاط</a
                                >
                                <a
                                    class="nav-item nav-link"
                                    id="nav-instructor-tab"
                                    data-bs-toggle="tab"
                                    href="#nav-instructor"
                                    role="tab"
                                    aria-controls="nav-instructor-tab"
                                    aria-selected="false"
                                >المحاضرين</a
                                >
                                <a
                                    class="nav-item nav-link"
                                    id="nav-feedback-tab"
                                    data-bs-toggle="tab"
                                    href="#nav-feedback"
                                    role="tab"
                                    aria-controls="nav-feedback-tab"
                                    aria-selected="false"
                                >الأسئلة و الأجوبة</a
                                >

                                @if($content->kind == 'separated')
                                    <a
                                        class="nav-item nav-link"
                                        id="nav-calendars-tab"
                                        data-bs-toggle="tab"
                                        href="#nav-calendars"
                                        role="tab"
                                        aria-controls="nav-calendars-tab"
                                        aria-selected="false"
                                    >التقويمات</a
                                    >
                                @endif

                            </div>
                        </nav>

                        <div
                            class="tab-content tutori-course-content"
                            id="nav-tabContent"
                        >
                            <div
                                class="tab-pane fade show active"
                                id="nav-home"
                                role="tabpanel"
                                aria-labelledby="nav-home-tab"
                            >
                                <div class="single-course-details">
                                    @if(!is_null($content->video_link))
                                        <div class="iframe-wrapper-alt my-4">
                                            <iframe
                                                src="{{$content->video_link}}"
                                                title="YouTube video player"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowfullscreen
                                            ></iframe>
                                        </div>
                                        <br />
                                    @endif

                                    <p>
                                        {!! $content->description !!}
                                    </p>
                                        <hr>
                                        {!! $content->video_link_active !!}
                                        <hr>
                                        {!! $content->video_link_active2 !!}
                                </div>
                                <h4 class="course-title mb-4 mt-5">التقييمات</h4>
                                <ul class="course-reviews-list">
                                    <!-- If No Comment for user before design -->
                                    @if(auth()->user()->type == 'student')
                                        <li>
                                            <div class="course-review">
                                                <div class="course-single-review">
                                                    @include('errors.validation_error_front')

                                                    <div class="question">
                                                        <div class="user-image">
                                                            <img
                                                                src="{{assetURLFile(auth()->user()->userInfo?->image)}}"
                                                                alt="user"
                                                                class="img-fluid"
                                                            />
                                                        </div>
                                                        <div class="user-content user-review-content">
                                                            <div class="review-text fs-14">
                                                                <form class="rate-form mt-4" method="post" action="{{route('website.courses.rating', $content->id)}}">
                                                                    @csrf
                                                                    <div class="wrapper d-flex flex-wrap gap-2">
                                                                        <input
                                                                            type="radio"
                                                                            class="btn-check"
                                                                            name="rating"
                                                                            id="weakRadio"
                                                                            autocomplete="off"
                                                                            value="1"
                                                                            @if(isset($userRating) && $userRating->rating == '1')
                                                                                checked
                                                                            @endif
                                                                        />
                                                                        <label for="weakRadio">ضعيف</label>
                                                                        <input
                                                                            type="radio"
                                                                            class="btn-check"
                                                                            name="rating"
                                                                            id="accepteRadio"
                                                                            autocomplete="off"
                                                                            value="2"
                                                                            @if(isset($userRating) && $userRating->rating == '2')
                                                                                checked
                                                                            @endif
                                                                        />
                                                                        <label for="accepteRadio">مقبول</label>
                                                                        <input
                                                                            type="radio"
                                                                            class="btn-check"
                                                                            name="rating"
                                                                            id="goodRadio"
                                                                            autocomplete="off"
                                                                            value="3"
                                                                            @if(isset($userRating) && $userRating->rating == '3')
                                                                                checked
                                                                            @endif
                                                                        />
                                                                        <label for="goodRadio">جيد</label>
                                                                        <input
                                                                            type="radio"
                                                                            class="btn-check"
                                                                            name="rating"
                                                                            id="vgoodRadio"
                                                                            autocomplete="off"
                                                                            value="4"
                                                                            @if(isset($userRating) && $userRating->rating == '4')
                                                                                checked
                                                                            @endif
                                                                        />
                                                                        <label for="vgoodRadio">جيد جدا</label>
                                                                        <input
                                                                            type="radio"
                                                                            class="btn-check"
                                                                            name="rating"
                                                                            id="excRadio"
                                                                            autocomplete="off"
                                                                            value="5"
                                                                            @if(isset($userRating) && $userRating->rating == '5')
                                                                                checked
                                                                            @endif
                                                                        />
                                                                        <label for="excRadio">ممتاز</label>

                                                                    </div>
                                                                    <div class="wrapper mt-4">
                                                                    <textarea
                                                                        class="form-control"
                                                                        name="comment"
                                                                        id="comment"
                                                                        rows="4"
                                                                        placeholder="اكتب تعليقك هنا ...."
                                                                        required
                                                                    >{!! ($userRating) ? $userRating->comment : ''  !!}</textarea>
                                                                    </div>
                                                                    <div
                                                                        class="wrapper d-flex justify-content-start mt-4"
                                                                    >
                                                                        <button class="btn-main">
                                                                            @if(isset($userRating))
                                                                                تعديل
                                                                            @else
                                                                                إرسال التعليق
                                                                            @endif
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    <!-- Other users comment design -->
                                    <li>
                                        <div class="course-review">
                                            @foreach($content->comments as $comment)
                                                <div class="course-single-review">
                                                    <div class="question">
                                                        <div class="user-image">
                                                            <img
                                                                src="{{assetURLFile($comment->student?->userInfo?->image)}}"
                                                                alt="user"
                                                                class="img-fluid"
                                                            />
                                                        </div>
                                                        <div class="user-content user-review-content">
                                                            <div class="review-header mb-10">
                                                                <h4 class="user-name">
                                                              <span class="me-1 fs-16">
                                                                {{$comment->student?->name  }}
                                                              </span>
                                                                </h4>
                                                            </div>
                                                            <div class="review-text fs-14">
                                                                <div class="stars">
                                                                    @for($i=1; $i <= $comment->rating; $i++)
                                                                        <span><i class="{{$i}}
                                                                            fas fa-star text-star">
                                                                        </i></span>
                                                                    @endfor
                                                                    @for($i=1; $i <= 5- $comment->rating; $i++)
                                                                        <span><i class="{{$i}}
                                                                                far fa-star text-star">
                                                                        </i></span>
                                                                    @endfor

                                                                </div>
                                                                <div class="review-content">
                                                                    {!! $comment->comment !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div
                                class="tab-pane fade"
                                id="nav-topics"
                                role="tabpanel"
                                aria-labelledby="nav-topics-tab"
                            >
                                <div class="tutori-course-curriculum">
                                    <div class="curriculum-scrollable">
                                        <ul class="curriculum-sections">
                                            <li class="section">
                                                <div class="section-header">
                                                    <div class="section-left">
                                                        <h5 class="section-title">تفاصيل النشاط</h5>
                                                        <p class="section-desc">
                                                            {!! $content->short_description !!}
                                                        </p>
                                                    </div>
                                                </div>

                                                <ul class="section-content">
                                                    @foreach($content->files as $file)
                                                        <li class="course-item course-item-lp_assignment course-item-lp_lesson">
                                                            <a class="section-item-link" href="{{assetURLFile($file->file_uploaded)}}" download><span class="item-name"> {{$file->name}} <i class="far fa-download ms-2 text-danger"></i></span>
                                                                <div class="course-item-meta">
                                                                    <span class="item-meta count-questions"> {{$file->file_type}}</span>

                                                                </div>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tutori-course-curriculum">
                                    <div class="curriculum-scrollable">
                                        @if(auth()->user()->type == 'student')
                                            <ul class="curriculum-sections">
                                                <li class="section">
                                                    <div class="p-3">
                                                        <h4>الجزء الخاص بالمتعلم</h4>
                                                    </div>

                                                    @if(checkUserUploadCourseAnswer($content->id) == 'false')
                                                        <div class="wrap px-3">
                                                            <p class="section-desc">
                                                                قم بتنزيل الملفات وقم بحلها ثم قم برفع الإجابة في ملف واحد من هنا
                                                            </p>
                                                            <form method="post" action="{{route('website.courses.studentUploadCourseFileAnswers', $content->id)}}" class="activity-form" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-md-12 mb-3">
                                                                        <div class="form-group mb-0">
                                                                            <input
                                                                                class="form-control py-3"
                                                                                type="file"
                                                                                name="file_uploaded"
                                                                                required
                                                                                style="height: auto; border-color:#e7e7e7"
                                                                            />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <button type="submit" class="btn-main h-100">
                                                                            <i class="far fa-upload me-2"></i>
                                                                            رفع الملف
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    @else
                                                        <ul class="section-content mt-3">

                                                            @foreach($studentsFileAnswers as $answerFile)
                                                                <li class="course-item course-item-lp_assignment course-item-lp_lesson studentFileLi">
                                                                    @if(!is_null($answerFile->degree))
                                                                        <div class="my-2 mx-4 mb-3">
                                                                            <h5 class="">
                                                                        <span
                                                                            class="ms-2 @if($answerFile->degree == '1') bg-danger @else bg-success @endif fs-12 py-1 px-3 rounded-pill text-white"
                                                                        >
                                                                          <i class="far fa-check-circle me-1"></i>
                                                                          التقدير :
                                                                            @if($answerFile->degree == '1')
                                                                                ضعيف
                                                                            @elseif($answerFile->degree == '2')
                                                                                مقبول
                                                                            @elseif($answerFile->degree == '3')
                                                                                جيد
                                                                            @elseif($answerFile->degree == '4')
                                                                                جيد جدا
                                                                            @elseif($answerFile->degree == '5')
                                                                                ممتاز
                                                                            @endif
                                                                        </span>
                                                                                <span
                                                                                    class="ms-3 fs-14 py-1 rounded-pill text-star"
                                                                                >
                                                                            @for($i=1; $i<=$answerFile->degree;$i++)
                                                                                        <span class="{{$i}}"><i class="fas fa-star"></i></span>
                                                                                    @endfor
                                                                                    @for($i=1; $i<=(5 - $answerFile->degree);$i++)
                                                                                        <span class="{{$i}}"><i class="far fa-star"></i></span>
                                                                                    @endfor
                                                                        </span>
                                                                            </h5>
                                                                        </div>
                                                                    @else
                                                                        <div class="my-2">
                                                                            <p class="alert-warning alert text-center">بإنتظار تصحيح المعلم وإعطاء الدرجة يمكنك حذف هذه الإجابة ورفع اجابة اخري  </p>
                                                                        </div>
                                                                    @endif
                                                                    <div class="d-flex align-content-center justify-content-between">
                                                                        @if(is_null($answerFile->degree) && $answerFile->student_id == auth()->user()->id)
                                                                            <a class="btn btn-sm btn-danger deleteBtn" href="{{route('website.courses.deleteUserFile', $answerFile->id)}}">
                                                                                <i class="fa fa-trash"></i> حذف
                                                                            </a>
                                                                        @endif
                                                                        <a class="section-item-link" download href="{{assetURLFile($answerFile->file_uploaded)}}">
                                                                    <span class="item-name">
                                                                      حل النشاط
                                                                      <i
                                                                          class="far fa-download ms-2 text-danger"
                                                                      ></i>
                                                                    </span>
                                                                            <div class="course-item-meta">
                                                                          <span class="item-meta count-questions"
                                                                          >ملف مرفوع {{$answerFile->file_ext}}</span
                                                                          >
                                                                                <span class="item-meta duration">{{$answerFile->student_answer_date}}</span
                                                                                ><i
                                                                                    class="fa item-meta course-item-status trans"
                                                                                ></i>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif

                                                </li>
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div
                                class="tab-pane fade"
                                id="nav-instructor"
                                role="tabpanel"
                                aria-labelledby="nav-instructor-tab"
                            >
                                <!-- Course instructor start -->
                                <div class="courses-instructor">

                                    @if(!is_null($content->teacher_id) && $content->kind == 'separated')
                                        <div class="single-instructor-box">
                                            <div class="row align-items-center">
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="instructor-image">
                                                        <img
                                                            src="{{assetURLFile($content->teacher?->userInfo?->image)}}"
                                                            alt="{{$content->teacher?->name}}"
                                                            class="img-fluid"
                                                        />
                                                    </div>
                                                </div>

                                                <div class="col-lg-8 col-md-8">
                                                    <div class="instructor-content">
                                                        <h4>{{$content->teacher?->name}}</h4>
                                                        <span class="sub-title">{{$content->teacher?->userInfo?->job_title}}</span>

                                                        <p>
                                                            {{$content->teacher?->userInfo?->qualification}} -
                                                            {{$content->teacher?->userInfo?->school_or_college}} -
                                                            {{$content->teacher?->userInfo?->department}} -
                                                            {{$content->teacher?->userInfo?->specialist}} -
                                                        </p>

                                                        <div class="intructor-social-links">
                                                            <span class="me-2">التواصل : </span>
                                                            <a href="{{$content->teacher?->userInfo?->facebook}}" target="_blank"> <i class="fab fa-facebook-f"></i></a>
                                                            <a href="{{$content->teacher?->userInfo?->twitter}}" target="_blank"> <i class="fab fa-twitter"></i></a>
                                                            <a href="{{$content->teacher?->userInfo?->linkedin}}" target="_blank">
                                                                <i class="fab fa-linkedin-in"></i
                                                                ></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else

                                        {{--Foreach units teachers--}}
                                        @if($content->lesson?->unit?->teachers)
                                            @foreach($content->lesson?->unit?->teachers as $teacher)
                                                <div class="single-instructor-box">
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-4 col-md-4">
                                                            <div class="instructor-image">
                                                                <img
                                                                    src="{{assetURLFile($teacher->userInfo?->image)}}"
                                                                    alt="{{$teacher->name}}"
                                                                    class="img-fluid"
                                                                />
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-8 col-md-8">
                                                            <div class="instructor-content">
                                                                <h4>{{$teacher->name}}</h4>
                                                                <span class="sub-title">{{$teacher->userInfo?->job_title}}</span>

                                                                <p>
                                                                    {{$teacher->userInfo?->qualification}} -
                                                                    {{$teacher->userInfo?->school_or_college}} -
                                                                    {{$teacher->userInfo?->department}} -
                                                                    {{$teacher->userInfo?->specialist}} -
                                                                </p>

                                                                <div class="intructor-social-links">
                                                                    <span class="me-2">التواصل : </span>
                                                                    <a href="{{$teacher->userInfo?->facebook}}" target="_blank"> <i class="fab fa-facebook-f"></i></a>
                                                                    <a href="{{$teacher->userInfo?->twitter}}" target="_blank"> <i class="fab fa-twitter"></i></a>
                                                                    <a href="{{$teacher->userInfo?->linkedin}}" target="_blank">
                                                                        <i class="fab fa-linkedin-in"></i
                                                                        ></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="my-4" />
                                            @endforeach
                                        @endif
                                    @endif


                                </div>
                                <!-- Conurse  instructor end -->
                            </div>
                            <div
                                class="tab-pane fade"
                                id="nav-feedback"
                                role="tabpanel"
                                aria-labelledby="nav-feedback-tab"
                            >
                                <div id="course-reviews">
                                    <ul class="course-reviews-list">
                                        @forelse($studentsQuestions as $question)
                                            <li>
                                                <div class="course-review">
                                                    <div class="course-single-review">
                                                        <div class="question">
                                                            <div class="user-image">
                                                                <img
                                                                    src="{{assetURLFile(auth()->user()->userInfo?->image)}}"
                                                                    alt="{{auth()->user()->name}}"
                                                                    class="img-fluid"
                                                                />
                                                            </div>
                                                            <div class="user-content user-review-content">
                                                                <div class="review-header mb-10">
                                                                    <h4 class="user-name">
                                                                        <span class="me-1">{{auth()->user()->name}} </span>
                                                                        @if(is_null($question->answer) && $question->student_id == auth()->user()->id)
                                                                            <a href="{{route('website.courses.deleteUserQuestion', $question->id)}}"
                                                                               class="btn btn-sm btn-danger  border-0 fs-12 rounded-pill py-1 px-2 text-decoration-underline"
                                                                            >
                                                                                <i class="far fa-trash me-1"></i>
                                                                                حذف
                                                                            </a>
                                                                        @endif
                                                                    </h4>
                                                                </div>
                                                                <div class="review-text">
                                                                    <div class="review-content">
                                                                        {!!$question->question!!}
                                                                    </div>
                                                                </div>
                                                                @if(!is_null($question->answer))
                                                                    <div class="reply mt-4">
                                                                        <div class="wrap">
                                                                    <span
                                                                        class="badge d-inline-block bg-success rounded-pill py-1 px-4 text-white fs-14 mb-3"
                                                                    >
                                                                      <i class="fa fa-check-circle me-1"></i>
                                                                      الإجابة
                                                                    </span>
                                                                        </div>
                                                                        <p class="mb-0">
                                                                            {!! $question->answer!!}
                                                                        </p>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                        @empty
                                            @include('website.layout.no_data')
                                        @endforelse
                                    </ul>

                                    @if(auth()->user()->type == 'student')
                                        <div class="question-form-wrapper mt-5">
                                            <form action="{{route('website.courses.studentAskQuestion', $content->id)}}" method="post" class="question-form">
                                                @csrf
                                                <div class="form-group">
                                              <textarea
                                                  name="question"
                                                  rows="4"
                                                  class="form-control"
                                                  placeholder="ادخل السؤال هنا ..."
                                                  required
                                                  style="border-color:#e7e7e7;"
                                              ></textarea>
                                                </div>
                                                <div class="form-group text-end">
                                                    <button class="btn-main">إرسال السؤال</button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>


                            <div
                                class="tab-pane fade"
                                id="nav-calendars"
                                role="tabpanel"
                                aria-labelledby="nav-calendars-tab"
                            >
                                <div class="row">
                                    @include('website.includes.calendars')
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-5 col-xl-4">
                        <!-- Course Sidebar start -->
                        <div class="course-sidebar course-sidebar-2 mt-5 mt-lg-0">
                            <div class="course-widget course-details-info">
                                <div class="course-thumbnail">
                                    <img
                                        src="{{assetURLFile($content->image)}}"
                                        alt="{{$content->title}}"
                                        class="img-fluid w-100"
                                    />
                                </div>

                                <ul class="course-sidebar-list">
                                    @if(!is_null($content->courseTerm))
                                        <li>
                                            <div
                                                class="d-flex justify-content-between align-items-center">
                                                <span><i class="far fa-sliders-h"></i>الفصل الدراسى</span>
                                                <span class="fs-14">{{ $content->courseTerm->name }}</span>
                                            </div>
                                        </li>
                                    @endif

                                    @if($content->kind == 'separated')
                                        <li>
                                            <div
                                                class="d-flex justify-content-between align-items-center">
                                                <span><i class="fas fa-users-class"></i>المجال</span>
                                                <span class="fs-14">{{$content->category?->title}}</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div
                                                class="d-flex justify-content-between align-items-center"
                                            >
                                                <span><i class="far fa-user"></i>المعلم</span>
                                                <span class="fs-14">{{$content->teacher?->name}}</span>
                                            </div>
                                        </li>

                                        <li>
                                            <div
                                                class="d-flex justify-content-between align-items-center">
                                                <span><i class="far fa-clock"></i>المقرر</span>
                                                <span class="ms-auto text-end fs-14" style="max-width: 200px;">
                                                    {{$content->scheduled?->title}}
                                                </span>
                                            </div>
                                        </li>
                                    @else
                                        <li>
                                            <div
                                                class="d-flex justify-content-between align-items-center"
                                            >
                                                <span><i class="fas fa-play-circle"></i>الدرس</span>
                                                <span class="fs-14">{{$content->lesson?->title}}</span>
                                            </div>
                                        </li>
                                    @endif



                                    <li>
                                        <div
                                            class="d-flex justify-content-between align-items-center">
                                            <span><i class="far fa-globe"></i>اللغة</span>
                                            <span class="fs-14">العربية</span>
                                        </div>
                                    </li>

                                    <li>
                                        <div
                                            class="d-flex justify-content-between align-items-center">
                                            <span><i class="far fa-calendar"></i>آخر تعديل</span>
                                            <span class="fs-14">{{$content->updated_at->translatedFormat('jS F Y')}}</span>
                                        </div>
                                    </li>
                                </ul>
                                <div class="buy-btn">
                                    @if(isset($favorite))
                                        <a href="{{route('website.courses.myFavorite')}}"
                                           class="button button-enroll-course btn btn-main-2 rounded"
                                        >
                                            <i class="far fa-heart me-2"></i> الذهاب الي أنشطتي
                                        </a>
                                    @else
                                        <a href="{{route('website.courses.addToFavorite', $content->id)}}"
                                           class="button button-enroll-course btn btn-main-2 rounded"
                                        >
                                            <i class="far fa-heart me-2"></i> أضف للمفضلة
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Course Sidebar end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--course section end-->

    @if($relatedCourses->count() > 0)
        <section class="section-padding page bg-light">
            <div class="container mb-5">
                <div class="head">
                    <h4 class="fw-bold">أنشطة ذات صلة</h4>
                </div>
            </div>
            <div class="container">
                <div class="row d-flex justify-content-start">
                    @foreach($relatedCourses as $con)
                        @include('website.includes.course')
                    @endforeach
                </div>
            </div>
            <!--course-->
        </section>
    @endif

@endsection
