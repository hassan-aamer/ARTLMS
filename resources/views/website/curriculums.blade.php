@extends('website.layout.master')

@section('page_title')   {{$page_title}}  @endsection
@section('content')

    @include('website.layout.inner-header')
    <section class="section-padding page bg-light">
        <div class="container">
            <div class="row d-flex justify-content-center">

                @forelse($content as $con)
                    <div class="col-lg-6 col-12">
                        <div class="course-grid bg-shadow tooltip-style">
                            <div class="course-header">
                                <div class="course-thumb">
                                    <img
                                        src="{{assetURLFile($con->image)}}"
                                        alt="{{$con->title}}"
                                        class="img-fluid"
                                    />
                                    <div class="course-price">المناهج</div>
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
                                    <a href="{{route('website.curriculums.show', $con->id)}}">{{$con->title}}</a>
                                </h3>

                                <div
                                    class="course-footer d-flex flex-lg-row flex-column gap-2 align-items-sm-center justify-content-start"
                                >
                                    <span class="duration"><i class="far fa-clock me-2"></i>{{$con->scheduleds_count}} مقرر</span>
                                    <span class="students"><i class="far fa-user-alt me-2"></i>متعدد الأنشطة</span>
                                    @if(!is_null($con->curriculumTerm->name) && !empty($con->curriculumTerm->name))
                                        <span class="students"><i class="far fa-list me-2"></i>{{ $con->curriculumTerm->name }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="course-hover-content">
                                <div class="price">المناهج</div>
                                <h3 class="course-title mb-0 mt-30">
                                    <a href="{{route('website.curriculums.show', $con->id)}}">{{$con->title}}</a>
                                </h3>
                                <p class="mb-20">
                                    {!!  \Illuminate\Support\Str::limit($con->short_description, 200, $end='...')!!}
                                </p>
                                <a href="{{route('website.curriculums.show', $con->id)}}" class="btn btn-grey btn-sm rounded"
                                >فتح المنهج <i class="fal fa-angle-left top-2 ms-2"></i
                                    ></a>
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
