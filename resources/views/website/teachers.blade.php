@extends('website.layout.master')

@section('page_title')  المحاضرين والمعلمين  @endsection
@section('content')

    @include('website.layout.inner-header')
    <!--course section start-->
    <section class="section-padding page bg-light">

        @include('website.layout.live_search')

        <div class="container">
            <div class="row live-search-list">

                @forelse($content as $con)
                    @if($con->userInfo?->status =='yes')
                    @include('website.includes.teacher')
                    @endif
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
