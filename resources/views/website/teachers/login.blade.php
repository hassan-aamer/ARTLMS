@extends('website.layout.master')

@section('page_title')  تسجيل دخول  للمحاضر  @endsection
@section('content')

    <section class="page-wrapper woocommerce single">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-xl-5">
                    <div class="woocommerce-notices-wrapper"></div>
                    <div class="login-form">
                        <div class="form-header">
                            <h2 class="font-weight-bold mb-2 fs-4">تسجيل الدخول للمحاضر</h2>
                            <p class="woocommerce-register" style="line-height: 20px">
                                ادخل بيانات الحساب وقم بتسجيل الدخول
                            </p>
                        </div>
                        <form method="post" action="{{route('website.teacher.login')}}" class="woocommerce-form woocommerce-form-login login">
                            @csrf

                            @if (Session::has('success'))
                                <div
                                    class="alert-success alert text-center d-flex justify-content-center align-items-center py-2 fs-14"
                                >
                                    <i class="fa fa-check-circle me-2"></i>
                                    {{ Session::get('success') }}
                                </div>
                            @endif


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
                            <p
                                class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-2"
                            >
                                <label for="password"
                                >كلمة السر<span class="required text-danger">*</span></label
                                >
                                <input
                                    class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                    type="password"
                                    name="password"
                                    id="password"
                                    autocomplete="current-password"
                                    placeholder="ادخل كلمة السر ..."
                                />
                            </p>

                            <div
                                class="d-flex align-items-center justify-content-between py-2"
                            >
                                <p class="form-row">
                                    <label
                                        class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme"
                                    >
                                        <input
                                            class="woocommerce-form__input woocommerce-form__input-checkbox"
                                            name="rememberme"
                                            type="checkbox"
                                            id="rememberme"
                                            value="forever"
                                        />
                                        <span>تذكرنى</span>
                                    </label>
                                </p>

                                <p class="woocommerce-LostPassword lost_password">
                                    <a class="text-muted" href="{{route('website.forget_password')}}">نسيت كلمة السر ؟</a>
                                </p>
                            </div>
                            <p class="form-row">
                                <button
                                    type="submit"
                                    class="woocommerce-button button woocommerce-form-login__submit"
                                    name="login"
                                    value="Log in"
                                >
                                    <i class="far fa-lock-alt me-1"></i>
                                    تسجيل الدخول
                                </button>
                            </p>
                            <div class="form-row text-center">
                                <p class="mb-0 fs-14">
                                    <i class="far fa-lock d-sm-inline-block d-none"></i>
                                     لتسجيل حساب كمحاضر
                                    <a class="text-decoration-underline" href="{{route('website.teacher.register_page')}}">اضغط هنا</a>
                                </p>
                                <p class="mb-0 fs-14">
                                    <i class="far fa-lock d-sm-inline-block d-none"></i>
                                    لتسجيل الدخول كمتعلم
                                    <a class="text-decoration-underline" href="{{route('website.student.login_page')}}">اضغط هنا</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
