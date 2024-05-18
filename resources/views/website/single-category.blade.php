@extends('website.layout.master')

@section('page_title')  المجالات والمحاور الفنية| {{$content->title}} @endsection
@section('content')

    @include('website.layout.inner-header')
    <!--course section start-->
    <section class="section-padding page bg-light">

        <div class="container">
            <div class="row g-4 mb-5">
                @if(!is_null($content->image))
                    <div class="col-12">
                        <div class="image mb-3">
                            <img class="img img-fluid" src="{{ assetURLFile($content->image) }}" alt="صورة المحور الفني">
                        </div>
                    </div>
                @endif
                @if(!is_null($content->description))
                    <div class="col-12">
                        <h4 class="course-title mb-2">وصف المحور الفني</h4>
                        <div class="head-decorator head-decorator-sm mb-4"></div>
                        <div class="text-wrap">
                            {!! $content->description !!}
                        </div>
                    </div>
                @endif
                @if(!is_null($content->video_link))
                    <div class="col-12">
                        <h4 class="course-title mb-2"> فيديو المحور الفني</h4>
                        <div class="head-decorator head-decorator-sm mb-4"></div>
                        <span class="d-block" style="margin: 30px 0"></span>
                        <div class="iframe-wrapper-alt">
                            {!! $content->video_link !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        @include('website.layout.live_search')

        <div class="container">

            <div class="row live-search-list">
                @forelse($content->courses as $con)
                    @include('website.includes.course')
                @empty
                    @include('website.layout.no_data')
                @endforelse
            </div>

        </div>
        </div>
        <!--course-->
    </section>

@endsection
