@extends('website.layout.master')

@section('page_title')  404 Error @endsection
@section('content')
    <section class="section-padding page bg-light text-center">
        <div class="image">
            <img src="{{asset('frontend/assets/images/404.png')}}" style="max-width: 350px" alt="404" />
        </div>
    </section>
@endsection
