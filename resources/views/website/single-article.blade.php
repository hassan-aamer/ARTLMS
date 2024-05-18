@extends('website.layout.master')

@section('page_title') المدونة| {{$content->title}} @endsection

@section('styles')

    @if($content->meta_description)
        <meta name="description" content="{!! $content->meta_description !!}" />
    @endif
    @if($content->keywords)
        <meta
            name="keywords"
            content="{{$content->keywords}}"
        />
    @endif

    <meta name="title" content="{{$content->title}}">
    <meta property="og:type" content="Website"/>
    <meta property="og:url" content="{{\Request::url()}}"/>
    <meta property="og:title" content="{{$content->title}}"/>
    <meta property="og:description" content="{!! strip_tags($content->description) !!}"/>
    <meta property="og:site_name" content="منصة فن التعليمية"/>
    <link rel ="canonical" href ="{{\Request::url()}}">
    <link rel="image_src" href="{{assetURLFile($content->image)}}" />
    <meta property="og:image" content="{{assetURLFile($content->image)}}"/>
    <meta property="og:image:url" content="{{assetURLFile($content->image)}}" />
    <meta itemprop="name" content="منصة فن التعليمية" />
    <meta itemprop="image" content="{{assetURLFile($content->image)}}" />
    <meta name="twitter:url" content="{{\Request::url()}}" />
    <meta name="twitter:title" content="منصة فن التعليمية" />
    <meta name="twitter:card" content="منصة فن التعليمية" />
    <meta name="twitter:site" content="{{\Request::url()}}" />
    <meta name="twitter:description" content="{!! strip_tags($content->description) !!}" />
    <meta name="twitter:creator" content="محمد نصر" />
    <meta name="twitter:image" content="{{assetURLFile($content->image)}}" />

    <style>
        .widget_tag_cloud a {
            border: 1px solid #d5d5d5 !important;
        }
    </style>

    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=64cf754e0fa8ca0019efa0b9&product=inline-share-buttons&source=platform" async="async"></script>
@endsection

@section('content')

    @include('website.layout.inner-header')
    <section class="section-padding page bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-8">
                    <div class="post-single">
                        <div class="post-thumb">
                            <img
                                src="{{assetURLFile($content->image)}}"
                                alt="{{$content->title}}"
                                class="img-fluid w-100"
                            />
                        </div>


                        <div class="single-post-content">
                            <div class="post-meta">
                  <span class="post-date"
                  ><i class="fa fa-calendar-alt mr-2"></i>{{$content->created_at->diffForHumans()}}</span
                  >
                                <span class="post-comments"
                                ><i class="fa fa-star text-star fs-12"></i
                                    ><i class="fa fa-star text-star fs-12"></i
                                    ><i class="fa fa-star text-star fs-12"></i
                                    ><i class="fa fa-star text-star fs-12"></i
                                    ><i class="fa fa-star text-star fs-12"></i>
                  </span>
                            </div>
                            <h3 class="post-title">{{$content->title}}</h3>
                            <div class="sharethis-inline-share-buttons my-4"></div>
                            <p>
                                {!! strip_tags($content->description) !!}
                            </p>



                            @include('website.includes.multiple_files')


                            <div class="my-4">
                                @if($content->video_link)
                                    <iframe
                                        src="{{$content->video_link}}"
                                        title="YouTube video player"
                                        frameborder="0"
                                        width="100%"
                                        height="400"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen
                                    ></iframe>
                                @endif
                            </div>




                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-4">
                    @if($related->count() > 0)
                        <div class="blog-sidebar mt-5 mt-lg-0">
                            <div class="widget widget_latest_post">
                                <h4 class="widget-title">أحدث المقالات</h4>
                                <div class="recent-posts">
                                    @foreach($related as $con)
                                        <div class="single-latest-post">
                                            <div class="widget-thumb">
                                                <a href="{{route('website.articles.show', $con->id)}}"
                                                ><img
                                                        src="{{assetURLFile($con->image)}}"
                                                        alt="{{$con->title}}"
                                                        class="img-fluid"
                                                    /></a>
                                            </div>
                                            <div class="widget-content">
                                                <h5>
                                                    <a href="{{route('website.articles.show', $con->id)}}">{{$con->title}}</a>
                                                </h5>
                                                <span><i class="far fa-calendar"></i> {{$con->created_at->diffForHumans()}}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                @if($categories->count() > 0)
                                    <div class="widget widget_categories">
                                        <h4 class="widget-title">التصنيفات</h4>
                                        <ul>
                                            @foreach($categories as $cat)
                                                <li class="cat-item"><a href="{{route('website.articles.index')}}?category_id={{$cat->id}}">{{$cat->name}}</a>({{$cat->articles_count}})</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if($tags->count() > 0)
                                    <div class="widget widget_tag_cloud">
                                        <h4 class="widget-title">الكلمات المفتاحية</h4>
                                        @foreach($tags as $tag)
                                            <a @if(in_array($tag->id, explode(',', $content->tags_id))) style="background: #ea3118;color:#fff" @endif href="{{route('website.articles.index')}}?tag_id={{$tag->id}}">{{$tag->name}}</a>
                                        @endforeach
                                    </div>
                                @endif



                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>


@endsection
