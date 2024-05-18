@extends('website.layout.master')

@section('page_title')   {{$page_title}}  @endsection
@section('content')

    @include('website.layout.inner-header')

    <section class="tutori-course-single tutori-course-layout-3 page-wrapper">
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
                                @if(!is_null($content->unitTerm))
                                    <h4 class="course-title">الفصل الدراسي</h4>
                                    <div class="head-decorator head-decorator-sm mb-4"></div>
                                    <p class="fw-600">
                                        <i class="fa fa-check-circle text-success me-2"></i>
                                        {{ $content->unitTerm->name }}
                                    </p>
                                    <br>
                                @endif
                                @if(!is_null($content->category))
                                    <h4 class="course-title">المجال / المحور الفني</h4>
                                    <div class="head-decorator head-decorator-sm mb-4"></div>
                                    <p class="fw-600">
                                        <i class="fa fa-check-circle text-success me-2"></i>
                                        <a class="text-muted text-decoration-underline" href="{{ url('category') . '/' . $content->category->id }}">
                                            {{ $content->category->title }}
                                        </a>
                                    </p>
                                    <br>
                                @endif
                                <h4 class="course-title">وصف الوحدة</h4>
                                <div class="head-decorator head-decorator-sm mb-4"></div>
                                <p>
                                    {!! $content->short_description !!}
                                </p>
                                {!! $content->video_link !!}
                            </div>
                            @include('website.includes.multiple_files')
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="head mb-5">
                        @if(auth()->user()->userInfo?->group_type == 'd')
                            <h4 class="fw-bold mb-3">دروس الوحدة</h4>
                        @else
                            <h4 class="fw-bold mb-3">دروس ومحاضرات الوحدة</h4>
                        @endif


                        <div class="head-decorator head-decorator-xs"></div>
                    </div>
                    <div class="row d-flex justify-content-start">

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
@endsection
