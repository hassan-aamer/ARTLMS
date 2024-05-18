@extends('website.layout.master')

@section('page_title')  تغيير كلمة المرور ؟ @endsection
@section('content')


    <section class="page-wrapper woocommerce single">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="woocommerce-notices-wrapper"></div>
                    <div class="login-form">
                        <div class="form-header">
                            <h2 class="font-weight-bold mb-2 fs-4">تغيير كلمة المرور</h2>
                            <p class="woocommerce-register" style="line-height: 20px">
                                ادخل كلمة المرور الجديدة ثم اضغط تأكيد لإتمام العملية
                            </p>
                        </div>
                        <form class="woocommerce-form change-pass-form" method="post" action="{{route('website.change_reset_password_post')}}">
                            @csrf

                            <input type="hidden" name="token" value="{{$token}}">
                            <p
                                class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3"
                            >
                                <label for="username"
                                >كلمة المرور الجديدة<span class="required text-danger"
                                    >*</span
                                    ></label
                                >
                                <input
                                    type="password"
                                    class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                    name="password"
                                    id="password"
                                    autocomplete="password"
                                    value=""
                                    placeholder="ادخل كلمة المرور الجديدة"
                                />
                            </p>
                            <p
                                class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3"
                            >
                                <label for="username"
                                >تأكيد كلمة المرور<span class="required text-danger"
                                    >*</span
                                    ></label
                                >
                                <input
                                    type="password"
                                    class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                    name="confirmPassword"
                                    id="confirmPassword"
                                    autocomplete="confirmPassword"
                                    value=""
                                    placeholder="ادخل كلمة السر الجديدة مرة أخرى"
                                />
                            </p>
                            <p class="form-row mt-4">
                                <button
                                    type="submit"
                                    class="woocommerce-button button woocommerce-form-login__submit"
                                    name="login"
                                    value="Log in"
                                >
                                    تغيير كلمة المرور
                                </button>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
