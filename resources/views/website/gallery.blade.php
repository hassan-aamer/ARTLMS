@extends('website.layout.master')

@section('page_title')  المعارض الفنية| {{$content->title}} @endsection
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
                            <li><a href="{{route('website.galleries.index')}}"> المعارض الفنية</a></li>
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
                                    target="_blank"
                                    class="video_icon popup-video"
                                    href="{{$content->video_link}}"
                                ><i class="fal fa-play"></i
                                    ></a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <div class="single-course-details mb-4">
                        <h4 class="course-title">تفاصيل عن المعرض</h4>
                        <div class="my-3 d-flex">
                            @if($content->category_id)
                            <a class="btn btn-lg btn-warning text-white rounded-2" target="_blank" href="{{route('website.categories.show', $content->category?->id)}}">المجال : {{$content->category?->title}}</a>
                            @endif
                            @if($content->gallery_link)
                            <a class="btn btn-lg btn-info text-white rounded-2 mx-3" target="_blank" href="{{$content->gallery_link}}">رابط المعرض</a>
                            @endif
                        </div>
                        @if(!is_null($content->skills))
                            <div class="skills d-flex gap-2 mt-3 mb-4 pt-3">
                                @foreach($content->skills as $skill)
                                    <a href="{{ url('/skill') . '/' . $skill->id }}" class="badge bg-secondary text-white">
                                        {{ $skill->title }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                        <p>
                            {!! $content->description !!}
                        </p>
                        <div class="row my-4 g-4">
                            @if(!is_null($content->video_link_active))
                            <div class="col-12">
                                <div class="iframe-wrapper-alt">
                                    {!! $content->video_link_active !!}
                                </div>
                            </div>
                            @endif
                            @if(!is_null($content->video_link_active2))
                            <div class="col-12">
                                <div class="iframe-wrapper-alt">
                                    {!! $content->video_link_active2 !!}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="thm-separator"></div>
                <div class="col-12">
                    @include('website.includes.multiple_files')
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="head mb-5">
                        <h4 class="fw-bold mb-3">
                            الدروس و المحاضرات المرتبطة بالمعرض
                        </h4>
                        <div class="head-decorator head-decorator-xs"></div>
                    </div>
                    <div class="row d-flex">

                        @forelse($lessons_lectures_based_on_user_group_type as $con)
                            <div class="col-lg-4">
                                <div class="course-grid bg-shadow tooltip-style">
                                    <div class="course-header">
                                        <div class="course-thumb">
                                            <a href="{{route('website.lessons.show', $con->id)}}">
                                                <img
                                                    src="{{assetURLFile($con->image)}}"
                                                    alt="{{$con->title}}"
                                                    class="img-fluid"
                                                />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="course-content">
                                        <div class="rating mb-10">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <span>(5.0)</span>
                                        </div>

                                        <h3 class="course-title mb-10 h-auto">
                                            <a href="{{route('website.lessons.show', $con->id)}}">{{$con->title}}</a>
                                        </h3>

                                        <div class="course-footer d-flex flex-wrap flex-lg-row flex-column align-items-sm-center justify-content-start gap-2 mt-20 mb-10">
                                            <span class="lessons">
                                                <i class="far fa-typewriter me-1"></i>{{$content->title}}
                                            </span>
                                            <span class="lessons">
                                                <i class="far fa-book-reader me-1"></i>
                                                {{$content->scheduled?->title}}</span>
                                            <span class="lessons">
                                                <i class="far fa-book-reader me-1"></i>
                                                {{$con->type == 'lecture' ? 'محاضرة' : 'درس'}}
                                            </span>
                                            @if(!is_null($con->lessonTerm))
                                                <span class="lessons">
                                                <i class="far fa-list me-1"></i>
                                                {{ $con->lessonTerm->name }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            @include('website.layout.no_data')
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($galleries->count() > 0)
    <section class="bg-white py-5">
        <div class="container">
            <div
                class="head mb-5 d-flex flex-sm-row flex-column justify-content-sm-between align-items-center"
            >
                <h4>المزيد من المعارض الفنية</h4>
                <a href="{{route('website.galleries.index')}}" class="btn btn-main-outline rounded mt-sm-0 mt-3">
                    المزيد من المعارض الفنية
                    <i class="fa fa-chevron-left ms-2"></i>
                </a>
            </div>
            <div class="row">
                @foreach($galleries as $con)
                    @include('website.includes.gallery')
                @endforeach
            </div>
        </div>
    </section>
    @endif


@endsection
