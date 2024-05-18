@extends('website.layout.master')

@section('page_title')   نتائج البحث @endsection
@section('content')

    @include('website.layout.inner-header')
    <!--course section start-->
    <section class="section-padding page bg-light">

        <div class="container">
            <div class="row live-search-list">
                <div class="col-12 mb-5">
                    <h4>({{count($content)}}) نتائج</h4>
                </div>
                @forelse($content as $con)
                    @include('website.includes.course')
                @empty
                    @include('website.layout.no_data')
                @endforelse
            </div>
        </div>
        </div>
        <!--course-->
    </section>

@endsection
