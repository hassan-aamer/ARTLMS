@extends('website.layout.master')

@section('page_title')  جميع المهارات  @endsection
@section('content')

    @include('website.layout.inner-header')
    <!--course section start-->
    <section class="section-padding page bg-light">

        @include('website.layout.live_search')

        <div class="container">
            <div class="row live-search-list">

                @forelse($content as $con)
                @include('website.includes.skill')
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
