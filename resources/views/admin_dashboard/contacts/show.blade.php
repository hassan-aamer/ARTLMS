@extends('admin_dashboard.layout.master')
@section('Page_Title')   الرسائل | رسالة من {{$content->name}}   @endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>     الرسائل | رسالة من <small class="text-success">({{$content->name}})</small> </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <ul>
                                        <li class="mb-3">
                                            <strong>الأسم :</strong>
                                            <span>{{$content->name}}</span>
                                        </li>
                                        <li class="mb-3">
                                            <strong>البريد الإلكتروني :</strong>
                                            <span>{{$content->email}}</span>
                                        </li>
                                        <li class="mb-3">
                                            <strong>الهاتف :</strong>
                                            <span>{{$content->phone}}</span>
                                        </li>
                                        <li class="mb-3">
                                            <strong>الموضوع :</strong>
                                            <span>{{$content->subject}}</span>
                                        </li>
                                        <li class="mb-3">
                                            <strong>الرسالة :</strong>
                                            <span>{{$content->message}}</span>
                                        </li>
                                        <li class="mb-3">
                                            <strong>التوقيت :</strong>
                                            <span>{{$content->created_at->diffForHumans()}}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
            </div>
        </div>
    </div>

@endsection
