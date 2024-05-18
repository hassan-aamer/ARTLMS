@extends('website.layout.master')

@section('page_title')  {{$page_title}} @endsection

@section('styles')
    <style>
        .removeFromFavourite
        {
            background: red;
            border-radius: 5px;
            padding: 5px;
            text-align: center;
        }
        .removeFromFavourite a
        {
            color:#ffffff;
        }
    </style>
    @endsection

@section('content')

    @include('website.layout.inner-header')
    <!--course section start-->
    <section class="section-padding page bg-light">

        <div class="container">
            <div class="row live-search-list">
                @forelse($content as $con)
                    <div class="col-xl-4 col-lg-6 col-12 search_results">

                        <div class="removeFromFavourite">
                            <a href="{{route('website.courses.removeFromFavorite', $con->id)}}">
                                <i class="fa fa-trash"></i> إزالة من المفضلة
                            </a>
                        </div>
                        <div class="course-grid bg-shadow tooltip-style">
                            <div class="course-header">
                                <div class="course-thumb">
                                    <img
                                        src="{{assetURLFile($con->course?->image)}}"
                                        alt="{{$con->course?->title}}"
                                        class="img-fluid"
                                    />
                                    <div class="course-price">@if($con->course?->term == '1') ترم أول
                                        @else  ترم  ثاني @endif</div>
                                </div>
                            </div>

                            <div class="course-content">
                                <div class="rating mb-10">
                                    @for($i=1; $i<=getCourseRating($con->id); $i++)
                                        <i class="{{$i}} fa fa-star"></i>
                                    @endfor
                                    @for($i=1; $i<=5 - getCourseRating($con->id); $i++)
                                        <i class="{{$i}} far fa-star"></i>
                                    @endfor

                                    <span>{{getCourseRating($con->id)}} ({{getCourseRatingCount($con->id)}} مراجعة)</span>
                                </div>

                                <h3 class="course-title mb-20">
                                    <a href="{{route('website.courses.show', $con->course?->id)}}">{{$con->course?->title}}</a>
                                </h3>

                                <div
                                    class="course-footer mt-20 d-flex align-items-center justify-content-between"
                                >
                <span class="students"
                ><i class="far fa-list"></i>   عدد المهارات : {{$con->course?->skills->count()}}</span
                >
                                    <span class="lessons"
                                    ><i class="far fa-play-circle me-2"></i>@if($con->course?->term == '1') ترم أول
                                        @else  ترم  ثاني @endif</span
                                    >
                                </div>
                            </div>

                            <div class="course-hover-content">
                                <div class="price">@if($con->course?->term == '1') ترم أول
                                    @else  ترم  ثاني @endif</div>
                                <h3 class="course-title mb-20 mt-30">
                                    <a href="{{route('website.courses.show', $con->course?->id)}}">{{$con->course?->title}}</a>
                                </h3>
                                <div class="course-meta d-flex align-items-center mb-20">
                <span class="lesson"><i class="far fa-play-circle"></i> @if($con->course?->term == '1') ترم أول
                    @else  ترم  ثاني @endif</span>
                                    <span class="lesson"><i class="far fa-list"></i>   عدد المهارات : {{$con->course?->skills->count()}}</span>
                                </div>
                                <p class="mb-20">
                                    {!!  \Illuminate\Support\Str::limit($con->course?->short_description, 100, $end='...')!!}
                                </p>
                                <a href="{{route('website.courses.show', $con->course?->id)}}" class="btn btn-grey btn-sm rounded"
                                >اذهب للنشاط <i class="fal fa-angle-left"></i
                                    ></a>
                            </div>
                        </div>
                    </div>

                @empty
                    @include('website.layout.no_data')
                @endforelse
            </div>

        </div>
        </div>
        <!--course-->
    </section>

@endsection
