@extends('website.layout.master')

@section('page_title') {{$page_title}}  @endsection
@section('content')

    @include('website.layout.inner-header')
    <!--course section start-->

    <style>
        .meta-info .list-inline-item p{
            margin-bottom: 0.125rem;
        }
    </style>

    <section class="section-padding page bg-light">
        <div class="container">
            <div class="row">
                @forelse($content as $con)
                <div class="col-xl-12">
                    <div class="meeting-box mb-3">
                        <div class="row">
                            <div
                                class="col-xl-1 col-lg-2 col-md-3 d-flex justify-content-lg-start justify-content-center"
                            >
                                <div class="meeting-thumb w-100 mt-lg-0 mt-4 text-center">
                                    <a href="#">
                                        <img
                                            src="{{asset('frontend/assets/images/light-bulb.svg')}}"
                                            alt="دليل المستخدم لاستخدام منصة فن التعليمية"
                                            class="img img-fluid tool-thumb"
                                            style="max-width: 100px"
                                        />
                                    </a>
                                </div>
                            </div>
                            <div
                                class="col-xl-8 col-lg-7 col-md-5 d-flex justify-content-start align-items-center"
                            >
                                <div class="meeting-content px-3">
                                    <h3 class="meeting-title mb-2">
                                        <a href="#" onclick="return false;">{{$con->title}}</a>
                                    </h3>
                                    <div class="meta-info">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                              <span class="fs-14 text-secondary">
                                                {!! $con->description !!}
                                              </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-lg-3 col-md-4 d-flex justify-content-center align-items-center mt-lg-0 mt-4 mb-lg-0 mb-4"
                            >
                                @if($con->video_link)
                                <a class="btn-main popup  popup-video px-4 py-2 rounded-3 fs-14 fw-600"
                                    href="{{$con->video_link}}" >
                                    <i class="far fa-video top-2 me-1"></i>
                                    عرض الفيديو</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    @include('website.layout.no_data')
                @endforelse
            </div>
            @include('website.layout.paginate')
        </div>
        <!--course-->
    </section>

@endsection
