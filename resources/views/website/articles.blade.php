@extends('website.layout.master')

@section('page_title') المدونة @endsection
@section('content')

    @include('website.layout.inner-header')
    <!--course section start-->
    <section class="section-padding page bg-light">


        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="row">
                        @forelse($content as $con)
                            <div class="col-xl-6">
                                <div class="blog-item mb-30">
                                    <div class="post-thumb">
                                        <a href="{{route('website.articles.show', $con->id)}}"
                                        ><img
                                                src="{{assetURLFile($con->image)}}"
                                                alt="{{$con->title}}"
                                                class="img-fluid"
                                                style="height: 350px; width: 100%; object-fit: cover"
                                            /></a>
                                    </div>
                                    <div class="blog-content">
                                        <div class="post-meta">
                                            <span class="post-date"><i class="fa fa-calendar-alt mr-2"></i>{{$con->created_at->diffForHumans()}}</span>
                                            <span class="post-comments"
                                            ><i class="fa fa-star text-star fs-12"></i
                                                ><i class="fa fa-star text-star fs-12"></i
                                                ><i class="fa fa-star text-star fs-12"></i
                                                ><i class="fa fa-star text-star fs-12"></i
                                                ><i class="fa fa-star text-star fs-12"></i>
                                            </span>
                                        </div>
                                        <h3 class="post-title">
                                            <a style="font-weight: 800; font-size: 18px" href="{{route('website.articles.show', $con->id)}}"
                                            >{{$con->title}}</a
                                            >
                                        </h3>
                                        <p>
                                            {!! Illuminate\Support\Str::limit(strip_tags($con->description), 150) !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            @include('website.layout.no_data')
                        @endforelse
                    </div>
                </div>
            </div>

            @include('website.layout.paginate')

        </div>
        <!--course-->
    </section>
    <!--course section end-->

@endsection
