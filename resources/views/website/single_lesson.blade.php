@extends('website.layout.master')

@section('page_title')   {{$page_title}}  @endsection
@section('content')

    @include('website.layout.inner-header')

    <section class="tutori-course-single tutori-course-layout-3 page-wrapper pb-0">
        <div class="container">
            <div class="row d-flex justify-content-between mb-30">
                <div class="col-xl-10">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="course-thumbnail">
                                <img
                                    src="{{assetURLFile($content->image)}}"
                                    alt="{{$content->title}}"
                                    class="img-fluid w-100 fit-cover"
                                />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="single-course-details mb-4">
                                @if($content->lessonTerm)
                                    <h4 class="course-title">التفاصيل</h4>
                                    <div class="head-decorator head-decorator-sm mb-4"></div>
                                    @if(!is_null($content->category))
                                        <p class="fw-600 mb-2">
                                            <i class="fa fa-check-circle text-success me-2"></i>
                                            المجال/المحور الفني :
                                            <a class="text-dark text-decoration-underline" href="{{ url('category') . '/' . $content->category->id }}">
                                                {{ $content->category->title }}
                                            </a>
                                        </p>
                                    @endif
                                    @if(!is_null($content->lessonTerm))
                                        <p class="fw-600 mb-0">
                                            <i class="fa fa-check-circle text-success me-2"></i>
                                            {{ $content->lessonTerm->name }}
                                        </p>
                                    @endif
                                    @if(!is_null($content->gallery))
                                        <p class="fw-600 mb-0 mt-2">
                                            <i class="fa fa-check-circle text-success me-2"></i>
                                            المعرض الفني :
                                            <a class="text-bg-primary text-decoration-underline" href="{{ url('galleries') . '/' . $content->gallery->id }}">{{ $content->gallery->title }}</a>
                                        </p>
                                    @endif
                                    @if(!is_null($content->skills))
                                        <p class="fw-600 mt-2 mb-0">
                                            <i class="fa fa-check-circle text-success me-2"></i>
                                            المهارات :
                                            <span class="me-1"></span>
                                            @foreach($content->skills as $skill)
                                                <a href="{{ url('skill') . '/' . $skill->id }}" class="badge bg-secondary text-white">{{ $skill->title }}</a>
                                            @endforeach
                                        </p>
                                    @endif
                                    <div class="thm-separator"></div>
                                    <hr>
                                    <div class="thm-separator"></div>
                                @endif
                                <h4 class="course-title">نبذه عن الدرس</h4>
                                <div class="head-decorator head-decorator-sm mb-4"></div>
                                <p class="mb-0">
                                    {!! $content->short_description !!}
                                </p>
                                <div class="thm-separator"></div>
                                <div class="row g-4">
                                    @if(!is_null($content->video_link))
                                        <div class="col-lg-6">
                                            <div class="wrap iframe-wrapper-alt">
                                                {!! $content->video_link !!}
                                            </div>
                                        </div>
                                    @endif
                                    @if(!is_null($content->video_link2))
                                        <div class="col-lg-6">
                                            <div class="wrap iframe-wrapper-alt">
                                                {!! $content->video_link2 !!}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="thm-separator"></div>
                            </div>
                            @include('website.includes.multiple_files')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-light pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="head mb-5">
                        <h4 class="fw-bold mb-3">
                            @if($content->type == 'lesson')
                                المهارات المكتسبة من هذا الدرس
                            @else
                                المهارات المكتسبة من هذه المحاضرة
                            @endif
                            <span class="text-muted fs-16 ms-2">( {{$content->skills->count()}} مهاراة )</span>
                        </h4>
                        <div class="head-decorator head-decorator-xs"></div>
                    </div>
                    <div class="row d-flex">
                        @forelse($content->skills as $con)
                            @include('website.includes.skill')
                        @empty
                            @include('website.layout.no_data')
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="head mb-5">
                        <h4 class="fw-bold mb-3">
                            @if($content->type == 'lesson')
                                أنشطة الدرس
                            @else
                                أنشطة المحاضرة
                            @endif
                            <span class="text-muted fs-16 ms-2">( {{$content->courses->count()}} أنشطة )</span>
                        </h4>
                        <div class="head-decorator head-decorator-xs"></div>
                    </div>
                    <div class="row d-flex">
                        @forelse($content->courses as $con)
                            @include('website.includes.course')
                        @empty
                            @include('website.layout.no_data')
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-light py-4">
        <div class="container">
            <div class="row">
                @include('website.includes.calendars')
            </div>
        </div>
    </section>

@endsection
