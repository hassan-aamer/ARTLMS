@extends('website.layout.master')

@section('page_title') {{$page_title}}  @endsection
@section('content')

    @include('website.layout.inner-header')
    <!--course section start-->
    <section class="section-padding page bg-light pt-5">

        <div class="container">
            <div class="row mb-4">
                <div class="col-12">
                    <h4 class="my-3"><strong>مقدمة</strong></h4>
                    <p>
                        {{getSettings('galleries_intro')}}
                    </p>
                </div>
            </div>
        </div>


        @include('website.layout.live_search')

        <div class="container">
            <div class="row live-search-list">

                @forelse($content as $con)
                    @include('website.includes.gallery')
                @empty
                    @include('website.layout.no_data')
                @endforelse
            </div>

            @include('website.layout.paginate')

        </div>
        <!--course-->
    </section>
    <!--course section end-->

@endsection
