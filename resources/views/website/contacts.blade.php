@extends('website.layout.master')

@section('page_title')  {{$page_title}} @endsection
<style>
    .form-control {
        border: 2px solid #e1e1e1 !important;
    }
</style>
@section('content')

    @include('website.layout.inner-header')
    <!--course section start-->
    <section class="contact section-padding">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-4 col-lg-5">
                    <div class="contact-info-wrapper mb-5 mb-lg-0">
                        <h3>
                            للاستفسارات
                            <span>تواصل معنا</span>
                        </h3>
                        <p>
                            ادخل البيانات المطلوبة فى النموذج الموضح وسيقوم أحد مديرى المنصة
                            بالتواصل معكم فى أقرب وقت
                        </p>

                        <div class="contact-item">
                            <i class="far fa-envelope"></i>
                            <h5>mohamednaser@spcd.psu.edu.eg</h5>
                        </div>

                        <div class="contact-item">
                            <i class="far fa-phone"></i>
                            <h5>0201280523323</h5>
                        </div>

                        <div class="contact-item">
                            <i class="fa fa-map-marker-alt"></i>
                            <h5>كلية التربية النوعية ـ جامعة بور سعيد</h5>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7 col-lg-6">
                    <form class="contact__form form-row" id="contactForm" method="post"
                          action="{{route('website.contacts.submit')}}">
                        @csrf
                        <x-honeypot />
                        <div class="row">
                            <div class="col-12">
                                <div
                                    class="alert alert-success contact__msg"
                                    style="display: none"
                                    role="alert"
                                >
                                    تم إرسال الرسالة بنجاح ، شكرا لكم
                                    <br />
                                    سيقوم أحد مديرى المنصة بالتواصل معكم فى أقرب وقت ممكن
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input
                                        type="text"
                                        id="name"
                                        required
                                        name="name"
                                        class="form-control"
                                        placeholder="الاسم كاملاً  (مطلوب)"
                                        @if(Auth::check())
                                            value="{{auth()->user()->name}}"
                                        @endif
                                    />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        required
                                        class="form-control"
                                        placeholder="البريد الإلكتروني  (مطلوب)"
                                        @if(Auth::check())
                                        value="{{auth()->user()->email}}"
                                        @endif
                                    />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input
                                        type="text"
                                        name="phone"
                                        id="phone"
                                        min="0"
                                        required
                                        class="form-control"
                                        placeholder="رقم الهاتف (مطلوب)"
                                        @if(Auth::check())
                                        value="{{auth()->user()->userInfo?->phone}}"
                                        @endif
                                    />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input
                                        type="text"
                                        name="subject"
                                        id="subject"
                                        required
                                        class="form-control"
                                        placeholder="الموضوع (مطلوب)"
                                    />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <textarea
                                        id="message"
                                        name="message"
                                        cols="30"
                                        rows="6"
                                        required
                                        class="form-control"
                                        placeholder="تفاصيل الرسالة أو الشكوى (مطلوب)"
                                    ></textarea>
                                </div>
                            </div>
                            <div class="form-group d-none">
                                <label for="spam">Spam
                                    <input type="text" name="spam" id="spam"  />
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="text-center">
                                <button class="btn btn-main w-100 rounded" type="submit">
                                    إرسال الرسالة
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!--course section end-->

@endsection


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('admin_dashboard/assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('admin_dashboard/assets/js/form-select2.js')}}"></script>
    <script>
    $(document).ready(function () {
        $("#contactForm").validate({
            rules: {
                name: {
                    required: true,
                },
                email: {
                    required: true,
                    email:true
                },
                phone: {
                    required: true,
                    minlength:7,
                    maxlength:20,
                },
                subject: {
                    required: true,
                },
                message: {
                    required: true,
                },

            },
            messages: {
                name: {
                    required: "الحقل مطلوب",
                },
                email: {
                    required: "الحقل مطلوب",
                    email: "صيغة البريد الإلكتروني خاطئة",
                },
                phone: {
                    required: "الحقل مطلوب",
                    minlength: "يجب أن يكون عدد الأرقام أكبر من 6 أرقام",
                    maxlength: "يجب أن يكون عدد الأرقام أصغر من 20 رقم",
                },
                subject: {
                    required: "الحقل مطلوب",
                },
                message: {
                    required: "الحقل مطلوب",
                },

            }
        });
    });
</script>
@endpush

