@extends('website.layout.master')

@section('page_title')  نسيت كلمة المرور ؟ @endsection
@section('content')

    <section class="page-wrapper woocommerce single">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">


                    <div class="woocommerce-notices-wrapper"></div>
                    <div class="login-form">
                        <div class="form-header">
                            <h2 class="font-weight-bold mb-2 fs-4">طلب تغيير كلمة السر</h2>
                            <p class="woocommerce-register" style="line-height: 20px">
                                ادخل البريد الإلكترونى الخاص بك المسجل لدينا
                            </p>
                        </div>
                        <form class="woocommerce-form reset-pass-form" method="post" action="{{route('website.reset_password')}}">

                            @if (Session::has('message'))
                            <div
                                class="alert-danger alert text-center d-flex justify-content-center align-items-center py-2 fs-14"
                            >
                                <i class="fa fa-times-circle me-2"></i>
                                {{ Session::get('message') }}
                            </div>
                            @endif
                                @if (Session::has('success'))
                            <div
                                class="alert-success alert text-center d-flex justify-content-center align-items-center py-2 fs-14"
                            >
                                <i class="fa fa-check-circle me-2"></i>
                                {{ Session::get('success') }}
                            </div>
                                @endif



                            @csrf
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
                                    required
                                    placeholder="ادخل البريد الالكترونى"
                                />
                            </p>
                            <p class="form-row mt-4">

                                <button
                                    type="submit"
                                    class="woocommerce-button button woocommerce-form-login__submit"
                                    name="login"
                                    value="Log in"
                                >
                                    تأكيد الطلب
                                </button>
                            </p>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
