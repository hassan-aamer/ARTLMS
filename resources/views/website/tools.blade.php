@extends('website.layout.master')

@section('page_title') {{$page_title}}  @endsection
@section('content')

    @include('website.layout.inner-header')
    <!--course section start-->

    <section class="section-padding pb-5 page bg-light">
        <div class="container">
            <div class="row live-search-list">

                @forelse($content as $con)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="course-grid tooltip-style bg-white hover-shadow">
                            <div class="course-header">
                                <div class="course-thumb">
                                    <img
                                        src="{{assetURLFile($con->image)}}"
                                        alt="zoom"
                                        class="img-fluid tool-thumb"
                                    />
                                </div>
                            </div>
                            <div class="course-content">
                                <div class="rating mb-10">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="text-muted">
                    <i class="fa fa-book-reader me-1 text-muted"></i>
                    {{$con->type}}
                  </span>
                                </div>
                                <h3 class="course-title mb-20">
                                    <a href="{{$con->downloaded_link}}" target="_blank">{{$con->title}}</a>
                                </h3>
                                <div
                                    class="course-footer mt-20 mb-10 d-flex align-items-center justify-content-between"
                                >
                                    <a
                                        href="{{$con->downloaded_link}}" target="_blank"
                                        class="action btn-grey py-2 px-4 d-block w-100 text-center rounded-2"
                                    >
                                        <i class="far fa-download mw-1"></i>
                                        تحميل البرنامج
                                    </a>
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
