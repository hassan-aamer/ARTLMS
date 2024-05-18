@extends('website.layout.master')

@section('page_title') الصفحة الرئيسية  @endsection
@section('content')

<section class="banner-carousel owl-carousel">
    <div
        class="banner-style-4 banner-padding px-4"
        style="
    background: linear-gradient(to bottom left, rgba(142,196,160,0.83), rgba(47,8,3,0.74)),
      url({{ asset('frontend/assets/images/main-bg.jpeg')}});"
    >
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="academy-logos d-flex justify-content-between">
                        <img src="{{ asset('frontend/assets/images/university.png')}}" alt="Mohamed Nasr" />
                        <span class="mx-1"></span>
                        <img src="{{ asset('frontend/assets/images/Faculty-Logo-Trans.png')}}" alt="Mohamed Nasr" />
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <div class="faculty-text text-center">
                        <p class="text-white fs-2 fw-bold">جامعة بور سعيد</p>
                        <p class="text-white fs-2 fw-bold">كلية التربية النوعية</p>
                        <p class="text-white fs-2 fw-bold">قسم العلوم التربوية و النفسية</p>
                        <div class="title-b bg-white my-5 py-3 rounded-3 mx-auto" style="max-width: 500px">
                            <p class="fw-bold fs-3 text-dark mb-0">منصة فن التعليمية</p>
                        </div>
                        <h3 class="text-white text-center mx-auto mb-30" style="max-width: 800px;line-height: 40px">
                            فعالية استراتيجية التعلم المعكوس باستخدام الوسائط المعلوماتية فى
                            تنمية بعض المهارات التصميمية الرقمية لدى تلاميذ المرحلة
                            الابتدائية
                        </h3>
                        <p class="text-info fs-4 fw-bold">
                            العام الدراسي 2022 / 2023 م
                        </p>
                        <p class="fw-bold text-white mt-4 mb-5 fs-2">
                            مقدم من الباحث /
                            <br>
                            <span class="d-block mt-2">محمد نصر السيد مصطفى العادلي</span>
                        </p>
                        <p class="fw-bold text-white fs-3">
                            استكمالاً لمتطلبات الحصول على درجة دكتوراه الفلسفة في التربية النوعية
                        </p>
                        <p class="text-info fw-bold fs-4">
                            (قسم العلوم التربوية والنفسية – تخصص مناهج وطرق تدريس التربية الفنية)
                        </p>
                    </div>
                </div>
            </div>
            <!-- / .row -->
        </div>
        <!-- / .container -->
    </div>
    <div
        class="banner-style-4 banner-padding px-4"
        style="
    background: linear-gradient(to bottom left, rgba(136,136,136,0.47), rgba(9,6,6,0.94)),
      url({{ asset('frontend/assets/images/banner-2.jpg')}});"
    >
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="academy-logos d-flex justify-content-between">
                        <img src="{{ asset('frontend/assets/images/university.png')}}" alt="Mohamed Nasr" />
                        <span class="mx-1"></span>
                        <img src="{{ asset('frontend/assets/images/Faculty-Logo-Trans.png')}}" alt="Mohamed Nasr" />
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <div class="faculty-text text-center">
                        <p class="text-white fs-2 fw-bold">جامعة بور سعيد</p>
                        <p class="text-white fs-2 fw-bold">كلية التربية النوعية</p>
                        <p class="text-white fs-2 fw-bold">قسم العلوم التربوية و النفسية</p>
                        <div class="title-b bg-white my-5 py-3 rounded-3 mx-auto" style="max-width: 500px">
                            <p class="fw-bold fs-3 text-dark mb-0">منصة فن التعليمية</p>
                        </div>
                        <h3 class="text-white text-center mx-auto mb-30" style="max-width: 800px;line-height: 40px">
                            فعالية استراتيجية التعلم المعكوس باستخدام الوسائط المعلوماتية فى
                            تنمية بعض المهارات التصميمية الرقمية لدى تلاميذ المرحلة
                            الابتدائية
                        </h3>
                        <p class="text-info fs-4 fw-bold">
                            العام الدراسي 2022 / 2023 م
                        </p>
                        <p class="fw-bold text-white mt-4 mb-5 fs-2">
                            مقدم من الباحث /
                            <br>
                            <span class="d-block mt-2">محمد نصر السيد مصطفى العادلي</span>
                        </p>
                        <p class="fw-bold text-white fs-3">
                            استكمالاً لمتطلبات الحصول على درجة دكتوراه الفلسفة في التربية النوعية
                        </p>
                        <p class="text-info fw-bold fs-4">
                            (قسم العلوم التربوية والنفسية – تخصص مناهج وطرق تدريس التربية الفنية)
                        </p>
                    </div>
                </div>
            </div>
            <!-- / .row -->
        </div>
        <!-- / .container -->
    </div>
    <div
        class="banner-style-4 banner-padding px-4"
        style="
    background: linear-gradient(to bottom left, rgba(210,210,210,0.45), rgba(9,6,6,0.93)),
      url({{ asset('frontend/assets/images/banner-3.jpg')}});"
    >
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="academy-logos d-flex justify-content-between">
                        <img src="{{ asset('frontend/assets/images/university.png')}}" alt="Mohamed Nasr" />
                        <span class="mx-1"></span>
                        <img src="{{ asset('frontend/assets/images/Faculty-Logo-Trans.png')}}" alt="Mohamed Nasr" />
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <div class="faculty-text text-center">
                        <p class="text-white fs-2 fw-bold">جامعة بور سعيد</p>
                        <p class="text-white fs-2 fw-bold">كلية التربية النوعية</p>
                        <p class="text-white fs-2 fw-bold">قسم العلوم التربوية و النفسية</p>
                        <div class="title-b bg-white my-5 py-3 rounded-3 mx-auto" style="max-width: 500px">
                            <p class="fw-bold fs-3 text-dark mb-0">منصة فن التعليمية</p>
                        </div>
                        <h3 class="text-white text-center mx-auto mb-30" style="max-width: 800px;line-height: 40px">
                            فعالية استراتيجية التعلم المعكوس باستخدام الوسائط المعلوماتية فى
                            تنمية بعض المهارات التصميمية الرقمية لدى تلاميذ المرحلة
                            الابتدائية
                        </h3>
                        <p class="text-info fs-4 fw-bold">
                            العام الدراسي 2022 / 2023 م
                        </p>
                        <p class="fw-bold text-white mt-4 mb-5 fs-2">
                            مقدم من الباحث /
                            <br>
                            <span class="d-block mt-2">محمد نصر السيد مصطفى العادلي</span>
                        </p>
                        <p class="fw-bold text-white fs-3">
                            استكمالاً لمتطلبات الحصول على درجة دكتوراه الفلسفة في التربية النوعية
                        </p>
                        <p class="text-info fw-bold fs-4">
                            (قسم العلوم التربوية والنفسية – تخصص مناهج وطرق تدريس التربية الفنية)
                        </p>
                    </div>
                </div>
            </div>
            <!-- / .row -->
        </div>
        <!-- / .container -->
    </div>
</section>
<section class="banner-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="image author-img">
                    <img style="border: 10px solid #EBBE6A;object-fit: cover;object-position: top" width="250" height="250" class="rounded-circle" src="{{ asset('frontend/assets/images/research/nasr.png') }}" alt="Mohamed Nasr">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="section-heading mb-50">
                    <h3 class="font-lg mb-4 pb-2">عن الباحث</h3>
                    <ul class="check-list ps-4">
                        <li>
                            معلم تربية فنية بمدرسة الفاتح الابتدائية – إدارة شمال بورسعيد التعليمية
                        </li>
                        <li>
                            بكالوريوس التربية النوعية قسم التربية الفنية 2006 م
                        </li>
                        <li>
                            دبلوم خاص التربية النوعية قسم التربية الفنية 2010 م
                        </li>
                        <li>
                            ماجستير التربية النوعية تخصص (مناهج وطرق تدريس التربية الفنية) 2016 م
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 mt-6rem" id="goalSection">
                <div class="section-heading mb-50">
                    <h3 class="font-lg mb-4 pb-2">أهداف البحث</h3>
                    <div class="row justify-content-between">
                        <div class="col-lg-5">
                            <ul class="check-list">
                                <li>
                                    تحديد المهارات التصميمية الرقمية الواجب تنميتها لدى تلاميذ الصف السادس الإبتدائى.
                                </li>
                                <li>
                                    إعداد برنامج تعليمي مناسب باستخدام الوسائط المعلوماتية لتنمية بعض المهارات التصميمية الرقمية لدى التلاميذ
                                </li>
                                <li>
                                    التحقق من تأثير استخدام البرنامج على الجوانب / القدرات الوجدانية للمهارات لدى التلاميذ.
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-5">
                            <ul class="check-list">
                                <li>
                                    التحقق من تأثير استخدام البرنامج على الجوانب / القدرات الأدائية - المهارية للمهارات لدى التلاميذ
                                </li>
                                <li>
                                    التحقق من تأثير استخدام البرنامج على الجوانب / القدرات المعرفية للمهارات لدى التلاميذ
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="counter-section4 banner-padding bg-light">
    <div class="container-fluid">
        <div class="row mx-lg-5">
            <div class="col-12 text-center mb-5">
                <h2 class="mb-5" style="font-weight: 800">
                    تحـــــت إشـــــــــراف
                </h2>
            </div>
            <div class="col-lg-3 col-md-6 d-flex justify-content-center">
                <div class="staff-img-item mb-5 mb-lg-0">
                    <div class="image mx-auto">
                        <img src="{{ asset('frontend/assets/images/001.jpg')}}" alt="research" />
                        <img
                            src="{{ asset('frontend/assets/images/pic-frame.png')}}"
                            alt="Frame"
                            class="frame"
                        />
                    </div>
                    <div class="text mt-6rem pt-3">
                        <h5 class="mb-3">أ.د. / جمال السيد تفاحه</h5>
                        <p class="desc">
                            أستاذ الصحة النفسية المتفرغ بقسم العلوم التربوية والنفسية –
                            <br>
                            بكلية التربية النوعية – جامعة بورسعيد
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 d-flex justify-content-center">
                <div class="staff-img-item mb-5 mb-lg-0">
                    <div class="image mx-auto">
                        <img src="{{ asset('frontend/assets/images/002.jpg')}}" alt="research" />
                        <img
                            src="{{ asset('frontend/assets/images/pic-frame.png')}}"
                            alt="Frame"
                            class="frame"
                        />
                    </div>
                    <div class="text mt-6rem pt-3">
                        <h5 class="mb-3">أ.م.د. / سامية يوسف صالح</h5>
                        <p class="desc">
                            أستاذ مساعد متفرغ بقسم العلوم التربوية والنفسية –
                            <br>
                            بكلية التربية النوعية – جامعة بورسعيد
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 d-flex justify-content-center">
                <div class="staff-img-item mb-5 mb-lg-0">
                    <div class="image mx-auto">
                        <img
                            class="fit-contain"
                            src="{{ asset('frontend/assets/images/003.jpg')}}"
                            alt="research"
                        />
                        <img
                            src="{{ asset('frontend/assets/images/pic-frame.png')}}"
                            alt="Frame"
                            class="frame"
                        />
                    </div>
                    <div class="text mt-6rem pt-3">
                        <h5 class="mb-3">
                            أ.م.د. / محمد عبد الرحمن السعدني
                        </h5>
                        <p class="desc">
                            أستاذ مساعد بقسم تكنولوجيا التعليم –
                            <br>
                            بكلية التربية النوعية – جامعة بورسعيد
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 d-flex justify-content-center">
                <div class="staff-img-item mb-5 mb-lg-0">
                    <div class="image mx-auto">
                        <img src="{{ asset('frontend/assets/images/004.jpg')}}" alt="research" />
                        <img
                            src="{{ asset('frontend/assets/images/pic-frame.png')}}"
                            alt="Frame"
                            class="frame"
                        />
                    </div>
                    <div class="text mt-6rem pt-3">
                        <h5 class="mb-3">أ.م.د. / عمرو أحمد الأطروش</h5>
                        <p class="desc">
                            أستاذ مساعد بقسم التربية الفنية –
                            <br>
                            بكلية التربية النوعية – جامعة بورسعيد
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if(count($skills) > 0)
<section class="course-wrapper section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="section-heading mb-70 text-center">
                    <h2 class="font-lg">قائمة المهارات</h2>
                    <p>تعرف على قائمة المهارات الأكثر استخداماً</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-lg-center">
           @foreach($skills as $con)
                @include('website.includes.skill')
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{route('website.skills.index')}}" class="btn btn-main-outline rounded"
            >عرض جميع المهارات
                <i class="fa fa-angle-left prelative-3px ms-2"></i
                ></a>
        </div>
    </div>
</section>
@endif
@if(count($teachers) > 0)
<section class="team section-padding bg-light">
    <div class="container">
        <div class="row mb-100">
            <div class="col-lg-8 col-xl-8">
                <div class="section-heading text-center text-lg-start">
                    <h2 class="fs-20">قائمة المحاضرين والمعلمين</h2>
                    <p>تعرف على فريق عمل منصة فن </p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($teachers as $con)
                @include('website.includes.teacher')
            @endforeach
        </div>

        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <a href="{{route('website.teachers.index')}}" class="btn btn-main-outline rounded"
                    >عرض جميع المحاضرين
                        <i class="fa fa-angle-left prelative-3px ms-2"></i
                        ></a>
                </div>
            </div>
        </div>

    </div>
</section>
@endif


<!-- Rate Modal -->
@if(hideRateModal() == false)
<div class="modal" tabindex="-1" id="rateModal">
    <div
        class="modal-dialog modal-dialog-centered"
        style="max-width: 600px"
    >
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body text-center pb-5">
                <div class="image">
                    <img
                        style="max-width: 200px; height: auto"
                        src="{{asset('frontend/assets/images/rate-img.png')}}"
                        alt="منصة فن"
                    />
                </div>
                <div class="text mt-4">
                    <p class="fs-5 fw-bold">
                        قم بتقييم المنصة الآن لمساعدتنا على
                        <br />
                        تقديم محتوى أفضل دائماً
                    </p>
                </div>
                <div class="actions mt-4 mb-2">
                    <a
                        class="btn btn-main px-4 py-2 fs-14 text-white rounded-2"
                        href="{{getSettings('رابط تقييم المنصة')}}"
                        target="_blank"
                    >
                        <i class="fa fa-star me-1"></i>
                        قيم المنصة الآن
                    </a>
                    <p class="mb-0 mt-3">
                        فى حال قمت بالتقييم بالفعل
                        <form method="post" action="{{route('website.student.alreadyRating')}}">
                            @csrf
                            <button type="submit"
                            class="fw-600 text-decoration-underline btn-sm btn-warning mt-3"
                                    style="min-width: 170px"
                            id="ratedBeforeButton">اضغط هنا</button>
                        </form>

                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
@push('scripts')
<script>
  $(window).on("load", function () {
    $("#rateModal")?.modal("show");
  });



</script>
@endpush
