@extends('website.layout.master')

@section('page_title')  تحقق البريد الإلكتروني @endsection
@section('content')
    <section class="section-padding page bg-light text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    @if($user->type=='teacher')
                        <p class="alert alert-warning">
                            تم التحقق من بريدك الإلكتروني بنجاح بإنتظار موافقة الأدمن علي حسابك
                        </p>
                    @else
                        <p class="alert alert-success">
                            تم التحقق من بريدك الإلكتروني بنجاح يمكنك تسجيل الدخول الآن
                            <a href="{{route('website.student.login_page')}}" class="btn btn-success">تسجيل الدخول</a>
                        </p>
                    @endif



                </div>
            </div>
        </div>
    </section>
@endsection
