@extends('website.layout.master')

@section('page_title') شكراً لك @endsection
<style>
    header:first-child
    {
        display: none;
    }
</style>
@section('content')
    <header class="header-style-1">
        <div class="header-topbar topbar-style-2">
            <div class="container">
                <div class="row g-2 justify-content-center">
                    <div
                        class="col-xl-7 col-lg-6 col-md-7 col-sm-6 justify-content-sm-start justify-content-center d-flex align-items-center"
                    >
                        <h1
                            class="text-white text-sm-start text-center mb-0 py-sm-0 py-1"
                            style="font-size: 14px !important"
                        >


                        </h1>
                    </div>

                    <div class="col-xl-5 col-lg-6 col-md-5 col-sm-6">
                        <div
                            class="d-sm-flex justify-content-center justify-content-lg-end"
                        >
                            <div class="header-socials text-center text-lg-end">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a
                                            class="btn btn-main px-4 py-1 fs-12 text-white rounded-2"
                                            href="{{ route('website.index') }}"
                                        >
                                            خروج من التقويم
                                            <i class="fa fa-angle-left ms-2"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="page-wrapper">
        <div class="quiz-intro-container">
            <div class="image">
                <img src="{{asset('frontend/assets/images/quiz-img.png')}}" alt="Start Exam" />
            </div>
            <div class="text">
                <h6 class="type">  شكراً لك ، {{auth()->user()->name}}</h6>
                <h4 class="name">شكراً لك</h4>
                <p class="desc text-muted mb-1">
                    تم إرسال الإجابات إلي المصحح ,
                    تابع نتائج التقويمات من خلال صحفة تقويماتي
                    <br>
                    <a href="{{route('website.student.calendars')}}">من هنا</a>
                </p>
            </div>
            <div class="action mt-4">
            </div>
        </div>
    </section>

@endsection
