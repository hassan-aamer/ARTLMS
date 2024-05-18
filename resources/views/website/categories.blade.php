@extends('website.layout.master')

@section('page_title')  المجالات والمحاور الفنية @endsection
@section('content')

    @include('website.layout.inner-header')
    <!--course section start-->
    <section class="section-padding page bg-light">

        @include('website.layout.live_search')

        <div class="container">
            <div class="row live-search-list">

                @forelse($content as $con)
                    <div class="col-xl-3 col-lg-4 col-md-6 search_results">
                        <div class="course-grid tooltip-style bg-white hover-shadow">
                            <div class="course-header">
                                <div class="course-thumb">
                                    <img
                                        src="{{assetURLFile($con->image)}}"
                                        alt="{{$con->title}}"
                                        class="img-fluid"
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
                                    <span>(5.0)</span>
                                    <span class="text-muted">
                    <i class="fa fa-book-reader me-1 text-muted"></i>
                    {{$con->courses?->count()}} نشاط
                  </span>
                                </div>
                                <h3 class="course-title mb-20">
                                    <a href="{{ route('website.categories.show', $con->id) }}">{{$con->title}}</a>
                                </h3>
                                <div
                                    class="course-footer mt-20 mb-10 d-flex align-items-center justify-content-between"
                                >
                                    <a
                                        href="{{ route('website.categories.show', $con->id) }}"
                                        class="action btn-grey py-2 px-4 d-block w-100 text-center rounded-2"
                                    >عرض المجال</a
                                    >
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
        </div>
        <!--course-->
    </section>
    <!--course section end-->

@endsection
