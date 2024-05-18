@extends('website.layout.master')

@section('page_title') {{$page_title}}  @endsection
@section('content')

    @include('website.layout.inner-header')
    <!--course section start-->

    <section class="section-padding pb-5 page bg-light">
        <div class="container">
            <div class="row live-search-list mx-auto">

                @forelse($content as $con)
                    <div class="col-xl-10 mx-auto">
                        <div class="meeting-box">
                            <div class="row g-lg-0 g-4">
                                <div
                                    class="col-xl-2 col-lg-3 d-flex justify-content-lg-start justify-content-center"
                                >
                                    <div class="meeting-thumb w-100 mt-lg-0 mt-4">
                                        <a href="{{$con->join_url}}" target="_blank">
{{--                                            <img--}}
{{--                                                src="{{asset('frontend/assets/images/zoom.png')}}"--}}
{{--                                                alt="zoom"--}}
{{--                                                class="img img-fluid tool-thumb"--}}
{{--                                            />--}}
                                            <i class="fab fa-google-plus-square" style="font-size: 115px;"></i>
                                        </a>
                                    </div>
                                </div>
                                <div
                                    class="col-xl-7 col-lg-6 d-flex justify-content-lg-start justify-content-center align-items-center"
                                >
                                    <div class="meeting-content text-lg-start text-center">
                                        <h3 class="meeting-title mb-1">
                                            <a href="{{$con->join_url}}" target="_blank">{{$con->title}}</a>
                                        </h3>
                                        <div class="meta-info">
                                            <ul class="list-inline">
{{--                                                <li class="list-inline-item">--}}
{{--                                                  <span class="fs-14 text-secondary">--}}
{{--                                                    <i class="far fa-calendar me-1"></i>--}}
{{--                                                      {{ \Carbon\Carbon::parse($con->start_time)->diffForHumans()}}--}}
{{--                                                  </span>--}}
{{--                                                </li>--}}
                                                <li class="list-inline-item">
                                                  <span class="fs-14 text-secondary">
                                                    <i class="far fa-calendar me-1"></i>
                                                    {{$con->start_time}}
                                                  </span>
                                                </li>
                                                <li class="list-inline-item">
                                                  <span class="fs-14">
                                                    <i class="far fa-clock me-1"></i>
                                                    {{$con->duration}} دقيقة
                                                  </span>
                                                </li>
                                                <li class="list-inline-item">
                                                  <span class="fs-14 text-secondary">
                                                    <i class="far fa-user-chart me-1"></i>
                                                    {{$con->teacher?->name}}
                                                  </span>
                                                </li>
{{--                                                <li class="list-inline-item">--}}
{{--                                                  <span class="fs-14 text-secondary">--}}
{{--                                                    <i class="far fa-lock-open me-1"></i>--}}
{{--                                                    كلمة المرور : <strong class="text-danger">{{$con->password}}</strong>--}}
{{--                                                  </span>--}}
{{--                                                </li>--}}
{{--                                                <li class="list-inline-item">--}}
{{--                                                  <span class="fs-14 text-secondary">--}}
{{--                                                    <i class="far fa-list me-1"></i>--}}
{{--                                                    الرمز التعريفي: {{$con->meeting_id}}--}}
{{--                                                  </span>--}}
{{--                                                </li>--}}
                                            </ul>
                                            <div class="status mt-2">
                                                <span class="badge bg-{{$con->end_time['alert']}} px-3 py-2">
                                                  <i class="far fa-check-circle me-1"></i>
                                                   {{$con->end_time['title']}}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="col-lg-3 d-flex justify-content-center align-items-center mb-lg-0 mb-4"
                                >
                                    @if($con->end_time['alert'] != 'danger')
                                    <a class="btn-main px-4 py-2 rounded-3" href="{{$con->join_url}}" target="_blank">
                                        <i class="fa fa-volume-up"></i>
                                        الانضمام للاجتماع</a>
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
