@extends('website.layout.master')

@section('page_title') {{$content->title}} @endsection
<style>
    header:first-child
    {
        display: none;
    }
</style>
@section('content')
<header class="header-style-1">
    <div class="header-topbar topbar-style-2">
        <div class="container">
            <div class="row g-2 justify-content-center">
                <div
                    class="col-xl-7 col-lg-6 col-md-7 col-sm-6 justify-content-sm-start justify-content-center d-flex align-items-center"
                >
                    <h1
                        class="text-white text-sm-start text-center mb-0 py-sm-0 py-1"
                        style="font-size: 14px !important"
                    >
                        <i class="far fa-question-circle me-2"></i>
                        {{$content->title}}
                    </h1>
                </div>

                <div class="col-xl-5 col-lg-6 col-md-5 col-sm-6">
                    <div
                        class="d-sm-flex justify-content-center justify-content-lg-end"
                    >
                        <div class="header-socials text-center text-lg-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a
                                        class="btn btn-main px-4 py-1 fs-12 text-white rounded-2"
                                        href="{{ route('website.index') }}"
                                    >
                                        خروج من التقويم
                                        <i class="fa fa-angle-left ms-2"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<section class="page-wrapper">
    <div class="quiz-intro-container">
        <div class="image">
            <img src="{{asset('frontend/assets/images/quiz-img.png')}}" alt="Start Exam" />
        </div>
        <div class="text">
            <h6 class="type"> مرحباً بك ، {{auth()->user()->name}}</h6>
            <h4 class="name">{{$content->title}}</h4>
            <p class="desc text-muted mb-1">
                قم بالإجابة على أسئلةا لتقويم فى الوقت المحدد له
                <strong
                >( سيتم تحويلك خارج صفحة الإجابات فور انتهاء الوقت المحدد
                    )</strong
                >
                ان لم تقم بتقديم الاجابات بواسطتك
            </p>
            <p class="text-muted">

                <strong>  <i class="far fa-check me-1"></i>الدرجة النهائية : {{$content->degree ?? 'غير محدد'}}</strong>
                <strong class="mx-3">  <i class="far fa-clock me-1"></i> وقت الأمتحان : {{$content->duration ?? 'غير محدد' }} دقيقة</strong>
                <strong>  <i class="far fa-question me-1"></i> عدد الأسئلة : {{$content->questions_count }} سؤال </strong>
                @if($content->type == 'final' && !is_null($content->curriculum))
                    <br>
                    <strong>
                        <i class="fa fa-list me-1"></i>
                        <span>{{ $content->curriculum->curriculumTerm?->name ? $content->curriculum->curriculumTerm?->name : 'الفصل الدراسي للمنهج غير محدد' }}</span>
                    </strong>
                @endif
            </p>

                @if(!is_null($content->skills) && count($content->skills) > 0)
                    <hr>
                    @if($content->type == 'staging')
                        <p class="text-dark fw-600 mb-2">المهارات المكتسبة من الدرس</p>
                    @elseif($content->type == 'final' && $content->final_type == 'before')
                        <p class="text-dark fw-600 mb-2">المهارات الواجب تنميتها</p>
                    @elseif($content->type == 'final' && $content->final_type == 'after')
                        <p class="text-dark fw-600 mb-2">المهارات الواجب توافرها</p>
                    @else
                        <p class="text-dark fw-600 mb-2">المهارات المكتسبة</p>
                   @endif
                    <div class="skills d-flex justify-content-center flex-wrap gap-2 mb-4">
                        @foreach($content->skills as $skill)
                            <span class="badge bg-secondary text-white">
                                {{ $skill->title }}
                            </span>
                        @endforeach
                    </div>
                    <hr>
               @endif

        </div>
        <div class="action mt-4">
            <a
                class="btn btn-main-2 px-4 py-2 fw-bolder fs-14 text-white rounded-2"
                href="{{route('website.calendars.go', $content->id)}}"
            >
                <i class="far fa-clock me-2"></i>

                ابدأ التقويم الآن
            </a>
        </div>
    </div>
</section>

@endsection
