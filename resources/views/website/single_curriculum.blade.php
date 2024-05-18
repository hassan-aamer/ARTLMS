@extends('website.layout.master')

@section('page_title')   {{$page_title}}  @endsection
@section('content')

    @include('website.layout.inner-header')

    <section class="tutori-course-single tutori-course-layout-3 page-wrapper">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-xl-7">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="course-thumbnail">
                                <img
                                    src="{{assetURLFile($content->image)}}"
                                    alt="{{$content->title}}"
                                    class="img-fluid w-100 fit-cover"
                                    style="max-height: 360px"
                                />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="single-course-details mb-4">
                                <h4 class="course-title">
                                    @if(!is_null($content->term))
                                        وصف المنهج
                                        <span class="text-muted fs-14">( {{ $content->term === 1 ? 'الفصل الدراسي الأول' : 'الفصل الدراسي الثاني' }} )</span>
                                    @endif
                                </h4>
                                <div class="head-decorator head-decorator-sm mb-4"></div>
                                <p>
                                   {!! $content->short_description !!}
                                </p>
                            </div>
                            @if(!empty($content->video_link))
                            <div class="single-course-details mb-4">
                                <h4 class="course-title">الفيديو التوضيحي</h4>
                                <div class="head-decorator head-decorator-sm mb-4"></div>
                                <div class="iframe-wrapper-alt">
                                    <iframe src="{{ $content->video_link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                </div>
                            </div>
                            @endif
                            @include('website.includes.multiple_files')
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="head mb-5">
                        <h4 class="fw-bold mb-3">مقررات المنهج</h4>
                        <div class="head-decorator"></div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        @foreach($content->scheduleds as $scheduled)
                        <div class="col-xl-12 col-md-6 col-12">
                            <div class="course-grid bg-shadow tooltip-style">
                                <div class="course-header">
                                    <div class="course-thumb">
                                        <img
                                            src="{{assetURLFile($scheduled->image)}}"
                                            alt="{{$scheduled->title}}"
                                            class="img-fluid"
                                        />
                                        <div class="course-price">المقررات</div>
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

                                    <h3 class="course-title mb-10">
                                        <a href="{{route('website.scheduleds.show', $scheduled->id)}}">{{$scheduled->title}}</a>
                                    </h3>
                                    <div class="course-footer d-flex flex-lg-row flex-column align-items-sm-center justify-content-start">
                                        <span class="lessons me-3">
                                            <i class="far fa-typewriter me-2"></i>{{$scheduled->category?->title}}</span>
                                        <span class="duration me-3">
                                            <i class="far fa-users-class me-2"></i>{{$scheduled->units->count()}} وحدة /باب
                                        </span>
                                    </div>
                                    @if(!is_null($scheduled->scheduleTerm->name))
                                        <p class="duration mb-0 fs-14 fw-600">
                                            <i class="far fa-list-alt me-2"></i>
                                            {{$scheduled->scheduleTerm->name}}
                                        </p>
                                    @endif
                                </div>
                                <div class="course-hover-content">
                                    <div class="price">المقررات</div>
                                    <h3 class="course-title mb-0 mt-30">
                                        <a href="{{route('website.scheduleds.show', $scheduled->id)}}">{{$scheduled->title}}</a>
                                    </h3>
                                    <p class="mb-20">
                                        {!!  \Illuminate\Support\Str::limit($scheduled->short_description, 100, $end='...')!!}
                                    </p>
                                    <a href="{{route('website.scheduleds.show', $scheduled->id)}}" class="btn btn-grey btn-sm rounded"
                                    >فتح المقرر <i class="fal fa-angle-left top-2 ms-2"></i
                                        ></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12">
                    @include('website.includes.calendars')
                </div>
            </div>
        </div>
    </section>

@endsection
