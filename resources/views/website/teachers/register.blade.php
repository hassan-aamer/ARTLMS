@extends('website.layout.master')

@section('page_title')  تسجيل حساب جديد للمحاضر  @endsection
@section('content')

    <section class="page-wrapper woocommerce single">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-7">
                    <div class="woocommerce-notices-wrapper"></div>
                    <div class="signup-form">
                        <div class="form-header">
                            <h2 class="font-weight-bold mb-2 fs-4">تسجيل حساب للمحاضر</h2>
                            <p class="woocommerce-register" style="line-height: 20px">
                                قم بإدخال البيانات التالية للتسجيل على المنصة
                            </p>
                        </div>

                        @include('errors.validation_error_front')

                        <form method="post" action="{{route('website.teacher.register')}}" class="woocommerce-form woocommerce-form-register register register-2" enctype="multipart/form-data">
                           @csrf
                            <div class="row">
                                <div class="col-12">
                                    <p
                                        class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3"
                                    >
                                        <label for="name"
                                        >الاسم كاملاً<span class="required text-danger"
                                            >*</span
                                            ></label
                                        >
                                        <input
                                            type="text"
                                            class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                            name="name"
                                            id="name"
                                            autocomplete="name"
                                            value=""
                                            placeholder="ادخل الاسم كاملاً"
                                        />
                                    </p>
                                </div>
                                <div class="col-xl-6">
                                    <p
                                        class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3"
                                    >
                                        <label for="username"
                                        >البريد الإلكترونى<span class="required text-danger"
                                            >*</span
                                            ></label
                                        >
                                        <input
                                            type="text"
                                            class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                            name="email"
                                            id="email"
                                            autocomplete="email"
                                            value=""
                                            placeholder="ادخل البريد الالكترونى"
                                        />
                                    </p>
                                </div>
                                <div class="col-xl-6">
                                    <p
                                        class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3"
                                    >
                                        <label for="username"
                                        >البريد الإلكتروني البديل (اختيارى)
                                        </label>
                                        <input
                                            type="text"
                                            class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                            name="second_email"
                                            id="altEmail"
                                            autocomplete="altEmail"
                                            value=""
                                            placeholder="البريد الإلكترونى البديل"
                                        />
                                    </p>
                                </div>
                                <div class="col-xl-6">
                                    <p
                                        class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3"
                                    >
                                        <label for="nid">الرقم القومى (اختيارى)</label>
                                        <input
                                            type="text"
                                            class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                            name="national_id"
                                            id="nid"
                                            autocomplete="nid"
                                            value=""
                                            placeholder="ادخل الرقم القومى"
                                        />
                                    </p>
                                </div>
                                <div class="col-xl-6">
                                    <p
                                        class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3"
                                    >
                                        <label for="city"
                                        >المدينة <span class="text-danger">*</span></label
                                        >
                                        <input
                                            type="text"
                                            class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                            name="city"
                                            id="city"
                                            autocomplete="city"
                                            value=""
                                            placeholder="ادخل مدينتك الحالية"
                                        />
                                    </p>
                                </div>
                                <div class="col-xl-6">
                                    <p
                                        class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3"
                                    >
                                        <label for="school"
                                        >المؤهل / الدرجة العلمية
                                            <span class="text-danger">*</span></label
                                        >
                                        <input
                                            type="text"
                                            class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                            name="qualification"
                                            id="qualification"
                                            autocomplete="qualification"
                                            value=""
                                            placeholder="ادخل المؤهل الدراسى"
                                        />
                                    </p>
                                </div>
                                <div class="col-xl-6">
                                    <p
                                        class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3"
                                    >
                                        <label for="spec"
                                        >التخصص <span class="text-danger">*</span></label
                                        >
                                        <input
                                            type="text"
                                            class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                            name="specialist"
                                            id="spec"
                                            autocomplete="school"
                                            value=""
                                            placeholder="ادخل التخصص"
                                        />
                                    </p>
                                </div>
                                <div class="col-xl-6">
                                    <p
                                        class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3"
                                    >
                                        <label for="school"
                                        >المدرسة / الكلية / المعهد
                                            <span class="text-danger">*</span></label
                                        >
                                        <input
                                            type="text"
                                            class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                            name="school_or_college"
                                            id="school"
                                            autocomplete="school"
                                            value=""
                                            placeholder="ادخل المدرسة أو الكلية أو المعهد"
                                        />
                                    </p>
                                </div>
                                <div class="col-xl-6">
                                    <p
                                        class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3"
                                    >
                                        <label for="gov">الإدارة / القسم (اختيارى)</label>
                                        <input
                                            type="text"
                                            class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                            name="department"
                                            id="gov"
                                            autocomplete="school"
                                            value=""
                                            placeholder="ادخل الإدارة أو القسم"
                                        />
                                    </p>
                                </div>
                                <div class="col-xl-6">
                                    <p
                                        class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-2"
                                    >
                                        <label for="phone"
                                        >رقم الهاتف<span class="required text-danger"
                                            >*</span
                                            ></label
                                        >
                                        <input
                                            class="woocommerce-Input woocommerce-Input--text input-text form-control numeric-input"
                                            type="text"
                                            name="phone"
                                            id="phone"
                                            autocomplete="phone"
                                            placeholder="xxx xxx xxxx"
                                        />
                                    </p>
                                </div>
                                <div class="col-xl-6">
                                    <p
                                        class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-2"
                                    >
                                        <label for="type"
                                        >المجموعه<span class="required text-danger">*</span></label
                                        >
                                        <select
                                            name="group_type"
                                            id="type"
                                            class="form-control form-select"
                                        >
                                            <option value="">-- اختر المجموعة --</option>
                                            <option value="d">مجموعة ضابطة (ض)</option>
                                            <option value="t">مجموعة تجريبية (ت)</option>
                                        </select>
                                    </p>
                                </div>

                                <div class="col-12">
                                    <p
                                        class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3"
                                    >
                                        <label for="image"
                                        >الصورة الشخصية
                                            <span class="text-danger">*</span></label
                                        >
                                        <input
                                            type="file"
                                            class="form-control"
                                            name="image"
                                            id="image"
                                        >
                                    </p>
                                </div>
                                <div class="col-xl-6">
                                    <p
                                        class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3"
                                    >
                                        <label for="city"
                                        >المسمى الوظيفي</label
                                        >
                                        <input
                                            type="text"
                                            class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                            name="job_title"
                                            id="job_title"
                                            autocomplete="job_title"
                                            value=""
                                            placeholder="ادخل المسمي الوظيفي"
                                        />
                                    </p>
                                </div>
                                <div class="col-xl-6">
                                    <p
                                        class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-2"
                                    >
                                        <label for="type"
                                        >النوع</label
                                        >
                                        <select
                                            name="gender"
                                            id="type"
                                            class="form-control form-select"
                                        >
                                            <option value="male">ذكر</option>
                                            <option value="female">أنثي</option>
                                        </select>
                                    </p>
                                </div>

                                <div class="col-12">
                                    <p
                                        class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3"
                                    >
                                        <label for="reason"
                                        >تفاصيل و سبب التقدم
                                            <span class="text-danger">*</span></label
                                        >
                                        <textarea
                                            class="form-control"
                                            name="reason"
                                            id="reason"
                                            rows="5"
                                            placeholder="ادخل تفاصيل و أسباب التسجيل"
                                        ></textarea>
                                    </p>
                                </div>
                                <div class="col-xl-6">
                                    <p
                                        class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-2"
                                    >
                                        <label for="password"
                                        >كلمة السر<span class="required text-danger"
                                            >*</span
                                            ></label
                                        >
                                        <input
                                            class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                            type="password"
                                            name="password"
                                            id="password"
                                            autocomplete="current-password"
                                            placeholder="ادخل كلمة السر"
                                        />
                                    </p>
                                </div>
                                <div class="col-xl-6">
                                    <p
                                        class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-2"
                                    >
                                        <label for="password"
                                        >تأكيد كلمة السر<span class="required text-danger"
                                            >*</span
                                            ></label
                                        >
                                        <input
                                            class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                            type="password"
                                            name="password_confirmation"
                                            id="confirmPassword"
                                            autocomplete="current-password"
                                            placeholder="ادخل كلمة السر مرة أخرى"
                                        />
                                    </p>
                                </div>
                            </div>
                            <p class="form-row mt-4">
                                <button
                                    type="submit"
                                    class="woocommerce-button button woocommerce-form-login__submit"
                                    name="login"
                                    value="Log in"
                                >
                                    <i class="far fa-lock-alt me-1"></i>
                                    تسجيل الحساب
                                </button>
                            </p>
                            <div class="form-row text-center">
                                <p class="mb-0 fs-14">
                                     سجل دخول كمحاضر
                                    <a class="text-decoration-underline" href="{{route('website.teacher.login_page')}}">اضغط هنا</a>
                                </p>
                                <p class="mb-0 fs-14">
                                    <i class="far fa-lock d-sm-inline-block d-none"></i>
                                    لتسجيل حساب كمتعلم
                                    <a class="text-decoration-underline" href="{{route('website.student.register_page')}}">اضغط هنا</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
