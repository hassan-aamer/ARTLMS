@extends('website.layout.master')

@section('page_title')  المهارات| {{$content->title}} @endsection
@section('content')

    <section class="course-page-header page-header-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-8">
                    <div class="course-header-wrapper mb-0 bg-transparent">
                        <h1 class="mb-3">{{$content->title}}</h1>
                        <div class="course-header-meta">
                            <ul class="inline-list list-info">
                                <li>
                                    <div class="list-rating">
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span class="rating-count">( 5.0 )</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <ul class="header-bradcrumb justify-content-center mt-4">
                            <li><a href="{{route('website.index')}}">الرئيسية</a></li>
                            <li><a href="{{route('website.skills.index')}}">المهارات</a></li>
                            <li class="active" aria-current="page">{{$content->title}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="tutori-course-single tutori-course-layout-3 page-wrapper">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-12 mb-4">
                    <div class="skill-carousel owl-carousel">
                        @foreach($content->images as $image)
                        <div class="course-thumbnail">
                            <img
                                src="{{assetURLFile($image->image)}}"
                                alt="{{$content->title}}"
                                class="img-fluid w-100"
                                style="max-height: 360px"
                            />
                        </div>
                        @endforeach
                        @if($content->video_link)
                            <div class="course-thumb-wrap">
                                <div class="course-thumbnail mb-0">
                                    <img
                                        src="{{asset('frontend/assets/images/video.png')}}"
                                        alt=""
                                        class="img-fluid w-100"
                                        style="max-height: 360px"
                                    />
                                </div>

                                <a
                                    class="popup video_icon"
                                    href="{{$content->video_link}}"
                                ><i class="fal fa-play"></i
                                    ></a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <div class="single-course-details mb-4">
                        <h4 class="course-title">تفاصيل عن المهارة</h4>
                        <p>
                            {!! $content->description !!}
                        </p>
                    </div>
                    @if($content->knowledge_desc)
                    <div class="single-course-details mb-4">
                        <h4 class="course-title">  الجانب المعرفى</h4>
                        <p>
                            {!! $content->knowledge_desc !!}
                        </p>
                    </div>
                    @endif
                    @if($content->performance_desc)
                    <div class="single-course-details mb-4">
                        <h4 class="course-title">الجانب الآدائى</h4>
                        <p>
                            {!! $content->performance_desc !!}
                        </p>
                    </div>
                    @endif
                    @if($content->sentimental_desc)
                    <div class="single-course-details mb-4">
                        <h4 class="course-title">الجانب الوجداني</h4>
                        <p>
                            {!! $content->sentimental_desc !!}
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light section-padding">
        <div class="container">
            <div
                class="head mb-5 d-flex flex-sm-row flex-column justify-content-sm-between align-items-center"
            >
                <h4>المزيد من المهارات</h4>
                <a href="{{route('website.skills.index')}}" class="btn btn-main-outline rounded mt-sm-0 mt-3">
                    المزيد من المهارات
                    <i class="fa fa-chevron-left ms-2"></i>
                </a>
            </div>
            <div class="row">
                @foreach($skills as $con)
                    @include('website.includes.skill')
                @endforeach
            </div>
        </div>
    </section>


@endsection
