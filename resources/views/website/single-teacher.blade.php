@extends('website.layout.master')

@section('page_title')  المحاضر  @endsection
@section('content')

    @include('website.layout.inner-header')

    <!--course section start-->
    <section class="section-padding page bg-light">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-10 col-12">
                    <div class="team-item team-item-4 bg-white mb-5">
                        <div class="team-img">
                            <a href="#">
                                <img
                                    src="{{assetURLFile($content->userInfo?->image)}}"
                                    alt="{{$content->name}}"
                                    class="img-fluid"
                                    onerror="this.src='{{asset('frontend/assets/images/clients/testimonial-avata-01.jpg')}}'"
                                />
                            </a>
                            <ul class="team-socials list-inline">
                                <li class="list-inline-item">
                                    <a href="{{$content->userInfo?->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{$content->userInfo?->twitter}}"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{$content->userInfo?->linkedin}}"><i class="fab fa-linkedin-in"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="team-content">
                            <div class="team-info">
                                <h4>{{$content->name}}</h4>
                                <p class="mb-0">{{$content->userInfo?->specialist}} - {{$content->userInfo?->job_title}}</p>
                                <ul class="socials list-inline mb-4">
                                    <li class="list-inline-item">
                                        <a href="{{$content->userInfo?->facebook}}"
                                        ><i class="fab fa-facebook-f text-color"></i
                                            ></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="{{$content->userInfo?->twitter}}"><i class="fab fa-twitter text-color"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="{{$content->userInfo?->linkedin}}"
                                        ><i class="fab fa-linkedin-in text-color"></i
                                            ></a>
                                    </li>
                                </ul>
                            </div>

                            <div class="course-meta">
                  <span class="duration"
                  ><i class="far fa-book-reader"></i>{{$content->courses->count()}} نشاط</span
                  >
                                <span class="lessons">
                    <i class="fa fa-star text-star fs-12"></i>
                    <i class="fa fa-star text-star fs-12"></i>
                    <i class="fa fa-star text-star fs-12"></i>
                    <i class="fa fa-star text-star fs-12"></i>
                    <i class="fa fa-star text-star fs-12"></i>
                  </span>
                            </div>
                        </div>
                    </div>

                    @if($content->reason)
                    <div class="card team-item team-item-4 mb-5 text-start bg-white">
                        <div class="card-body">
                            <div class="bio p-3">
                                <h4 class="head mb-3">نبذة</h4>
                                <p class="mb-0">
                                    {{$content->reason}}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($content->courses->count() > 0)
                    <div class="instructor-activities">
                        <div
                            class="d-flex flex-sm-row flex-column justify-content-sm-between align-items-sm-center justify-content-center align-items-center mb-5"
                        >
                            <h4 class="fw-bold mb-sm-0 mb-3">أنشطة المدرب</h4>
                            <a href="{{route('website.courses.index')}}" class="btn btn-main-outline rounded py-2 fs-14"
                            >عرض جميع الأنشطة
                                <i class="fa fa-angle-left prelative-3px ms-2"></i
                                ></a>
                        </div>
                        <div class="row g-4">

                            @foreach($content->courses as $con)
                                @include('website.includes.course')
                            @endforeach

                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!--course-->
    </section>
    <!--course section end-->

@endsection
