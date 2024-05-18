@extends('admin_dashboard.layout.master')
@section('Page_Title')      الأنشطة | الأسئلة والأجوبة   @endsection

@push('styles')
    <style>
        .label-label
        {
            position: absolute;
            left: 0;
            top: -2px;
            padding: 0 13px;
            border-radius: 10px;
            color: #fff;
            font-weight: bold;
            font-size: 12px;
        }
        .label-label.label-success
        {
            background: #0dc15d;
        }
        .label-label.label-danger
        {
            background: #ce2424;
        }
    </style>
    @endpush

@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0"> <i class="bi bi-file-code-fill"></i>    الأنشطة | الأسئلة والأجوبة الخاصة بالنشاط : {{$content->title}}  </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            @forelse($content->questions as $key=>$question)
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="question position-relative">
                                                @if(is_null($question->answer))
                                                    <span class="label-label label-danger"> غير مجاب </span>
                                                @else
                                                    <span class="label-label label-success">  تم الأجابة </span>
                                                @endif
                                                <h5> {{$key+1}} -   السؤال : {!!$question->question!!}</h5>
                                                @if(!is_null($question->answer))
                                                <p class="mx-4">الأجابة : {!! $question->answer !!}</p>
                                                 @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <div class="col-12 text-center">
                                    <h5>لا يوجد بيانات في الوقت الحالي</h5>
                                </div>
                            @endforelse
                        </div>
                    </div><!--end row-->
                </div>
            </div>
        </div>
    </div>

@endsection
